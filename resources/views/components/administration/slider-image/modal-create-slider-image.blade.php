<script>
function closeModalSlider() {
    document.getElementById('modalCreateSlider').style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("createSliderForm");
    if (!form) return; // prevenir el error si no existe

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("{{ route('dashboard.sliderimages.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(res => {
            if (!res.ok) throw new Error("Error en el servidor");
            return res.json();
        })
        .then(data => {
            alert(data.message);
            closeModalSlider();
            form.reset();
            location.reload();
        })
        .catch(err => {
            console.error("Error al crear imagen:", err);
            alert("No se pudo guardar la imagen.");
        });
    });
});
</script>

<div id="modalCreateSlider" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModalSlider()">&times;</span>
        <h2>Agregar imagen al slider</h2>

        <form id="createSliderForm" enctype="multipart/form-data">
            @csrf

            <label for="title">Título:</label>
            <input type="text" id="title" name="title" maxlength="250">

            <label for="link">Enlace (opcional):</label>
            <input type="text" id="link" name="link" placeholder="https://">

            <label for="image">Imagen:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            {{-- Puedes ocultar o preestablecer el site_id si es estático --}}
            <input type="hidden" name="site_id" value="1">
            {{-- Si estás autenticado, puedes usar: --}}
            <input type="hidden" name="user_register_id" value="{{ auth()->id() }}">

            <button type="submit" class="btn-submit">Guardar</button>
        </form>
    </div>
</div>