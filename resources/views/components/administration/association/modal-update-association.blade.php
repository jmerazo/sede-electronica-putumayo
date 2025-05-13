<div id="modalEditAssociation" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModalEditAssociation()">&times;</span>
        <h2>Editar Asociación</h2>

        <form id="editAssociationForm" enctype="multipart/form-data">
            @csrf
            @method('POST') {{-- Se sobrescribe con PUT vía JS --}}
            <input type="hidden" id="edit_id" name="id">

            <label for="edit_name">Nombre:</label>
            <input type="text" id="edit_name" name="name" required>

            <label for="edit_classification">Clasificación:</label>
            <input type="text" id="edit_classification" name="classification" required>

            <label for="edit_activity">Actividad:</label>
            <input type="text" id="edit_activity" name="activity">

            <label for="edit_description">Descripción:</label>
            <textarea id="edit_description" name="description" rows="4"></textarea>

            <label for="edit_sccope">Ámbito:</label>
            <input type="text" id="edit_sccope" name="sccope">

            <label for="edit_city">Ciudad:</label>
            <input type="text" id="edit_city" name="city">

            <label for="edit_address">Dirección:</label>
            <input type="text" id="edit_address" name="address">

            <label for="edit_cellphone">Teléfono:</label>
            <input type="text" id="edit_cellphone" name="cellphone">

            <label for="edit_email">Correo electrónico:</label>
            <input type="email" id="edit_email" name="email">

            <label for="edit_link">Enlace (Web o Red Social):</label>
            <input type="url" id="edit_link" name="link">

            <label for="edit_image">Imagen (opcional):</label>
            <input type="file" id="edit_image" name="image" accept="image/*">

            <img id="preview_edit_image" src="" alt="Imagen actual" style="max-height: 150px; display: none; margin-top: 10px; border-radius: 8px;">

            <button type="submit" class="btn-submit">Actualizar</button>
        </form>
    </div>
</div>
<script>
function openModalEditAssociation(id) {
    fetch(`/dashboard/association/${id}/edit`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("edit_id").value = data.id;
            document.getElementById("edit_name").value = data.name || '';
            document.getElementById("edit_classification").value = data.classification || '';
            document.getElementById("edit_activity").value = data.activity || '';
            document.getElementById("edit_description").value = data.description || '';
            document.getElementById("edit_city").value = data.city || '';
            document.getElementById("edit_address").value = data.address || '';
            document.getElementById("edit_cellphone").value = data.cellphone || '';
            document.getElementById("edit_email").value = data.email || '';
            document.getElementById("edit_link").value = data.link || '';
            document.getElementById("edit_sccope").value = data.sccope || '';

            const preview = document.getElementById("preview_edit_image");
            if (data.image) {
                preview.src = `/storage/${data.image}`;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }

            document.getElementById("modalEditAssociation").style.display = "flex";
        })
        .catch(err => {
            console.error("Error al cargar asociación:", err);
            alert("No se pudo cargar la información de la asociación.");
        });
}

function closeModalEditAssociation() {
    document.getElementById("modalEditAssociation").style.display = "none";
}

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("editAssociationForm");
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const id = document.getElementById("edit_id").value;
        const formData = new FormData(this);

        fetch(`/dashboard/association/${id}`, {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                "X-HTTP-Method-Override": "PUT"
            }
        })
        .then(res => res.json().then(data => ({ status: res.status, body: data })))
        .then(({ status, body }) => {
            if (status === 422) {
                alert("Errores: " + Object.values(body.errors).flat().join("\n"));
            } else if (status === 500) {
                alert("Error del servidor");
            } else {
                alert(body.message || "Asociación actualizada");
                closeModalEditAssociation();
                location.reload();
            }
        })
        .catch(err => {
            console.error("Error:", err);
            alert("No se pudo actualizar la asociación.");
        });
    });
});
</script>