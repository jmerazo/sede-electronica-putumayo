<div id="modalCreateEntitySetting" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModalEntitySetting()">&times;</span>
        <h2>Agregar Nueva Configuración</h2>

        <form id="createEntitySettingForm" enctype="multipart/form-data">
            @csrf
            <label for="entity_name">Nombre:</label>
            <input type="text" id="entity_name" name="entity_name" required>

            <label for="entity_acronym">Acrónimo:</label>
            <input type="text" id="entity_acronym" name="entity_acronym">

            <label for="document_number">Número de identificación Tributaria:</label>
            <input type="text" id="document_number" name="document_number">

            <label for="legal_representative">Representate Legal:</label>
            <input type="text" id="legal_representative" name="legal_representative" required>

            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address">

            <label for="phone">Telefono:</label>
            <input type="text" id="phone" name="phone">

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email">

            <label for="logo_path">Logo entidad:</label>
            <input type="file" id="logo_path" name="logo_path" accept="image/*">

            <label for="website">Página web:</label>
            <input type="url" id="website" name="website">  
            
            <label for="department">Departamento:</label>
            <select id="department" name="department">
                <option value="" selected disabled>Seleccione un departamento...</option>
            </select>

            <label for="city">Ciudad:</label>
            <select id="city" name="city">
                <option value="" selected disabled>Seleccione un municipio</option>
            </select>

            <button type="submit" class="btn-submit">Guardar</button>
        </form>
    </div>
</div>

<script>
function openModalEntitySetting() {
    document.getElementById('modalCreateEntitySetting').style.display = 'flex';
}

function closeModalEntitySetting() {
    document.getElementById('modalCreateEntitySetting').style.display = 'none';
}

document.getElementById("createEntitySettingForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("{{ route('dashboard.settings.store') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json().then(data => ({ status: response.status, body: data })))
    .then(({ status, body }) => {
        if (status === 422) {
            console.error("Errores de validación:", body);
            alert("Error: " + Object.values(body.errors).flat().join("\n"));
        } else if (status === 500) {
            console.error("Error del servidor:", body);
            alert("Error interno del servidor. Consulta la consola.");
        } else {
            alert(body.message || "Configuración creada exitosamente.");
            closeModalEntitySetting();
            location.reload();
        }
    })
    .catch(error => {
        console.error("Error inesperado:", error);
        alert("Hubo un problema al definir la configración.");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    fetch("{{ route('locates') }}")
        .then(response => response.json())
        .then(data => {
            const departmentSelect = document.getElementById("department");
            data.forEach(dept => {
                const option = document.createElement("option");
                option.value = dept.id;
                option.textContent = dept.name;
                departmentSelect.appendChild(option);
            });
        });
});

document.getElementById("department").addEventListener("change", function () {
    const departmentId = this.value;
    const citySelect = document.getElementById("city");
    citySelect.innerHTML = '<option value="" disabled selected>Seleccione un municipio</option>';

    fetch(`/locates/cities/${departmentId}`)
        .then(response => response.json())
        .then(cities => {
            cities.forEach(city => {
                const option = document.createElement("option");
                option.value = city.id;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        });
});
</script>