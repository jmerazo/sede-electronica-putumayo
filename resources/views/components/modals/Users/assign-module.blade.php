<script>
document.addEventListener("DOMContentLoaded", function () {
    const moduleSelect = document.getElementById("assign_module_id");
    const submoduleContainer = document.getElementById("submodule_list");
    const selectAllCheckbox = document.getElementById("select_all_submodules");

    window.openModuleModal = function (userId) {
        document.getElementById("assign_user_id").value = userId;
        document.getElementById("modalAssignModule").style.display = "flex";
        document.getElementById("assign_module_id").selectedIndex = 0;
        document.getElementById("submodule_list").innerHTML = '';
        document.getElementById("select_all_submodules").checked = false;

        // Cargar los submódulos asignados
        fetch(`/dashboard/usermodules/user/${userId}/permissions`)
            .then(res => res.json())
            .then(data => {
                window.assignedSubmodules = (data.submodules || []).map(sub => sub.id);
            });
    };

    window.closeModuleModal = function () {
        document.getElementById("modalAssignModule").style.display = "none";
    }

    moduleSelect.addEventListener("change", function () {
        const moduleId = this.value;
        submoduleContainer.innerHTML = '<p>Cargando...</p>';

        fetch(`/dashboard/submodules/by-module/${moduleId}`)
            .then(res => res.json())
            .then(data => {
                submoduleContainer.innerHTML = '';
                if (data.length === 0) {
                    submoduleContainer.innerHTML = '<p>No hay submódulos disponibles.</p>';
                    return;
                }

                data.forEach(sub => {
                    const checkboxWrapper = document.createElement("div");
                    checkboxWrapper.classList.add("checkbox-item");

                    const isChecked = window.assignedSubmodules?.includes(sub.id);

                    checkboxWrapper.innerHTML = `
                        <label>
                            <input type="checkbox" name="submodules[]" value="${sub.id}" ${isChecked ? 'checked' : ''}>
                            ${sub.name}
                        </label>
                    `;

                    submoduleContainer.appendChild(checkboxWrapper);
                });
            })
            .catch(err => {
                console.error("Error cargando submódulos:", err);
                submoduleContainer.innerHTML = '<p>Error al cargar.</p>';
            });
    });

    selectAllCheckbox.addEventListener("change", function () {
        const checkboxes = submoduleContainer.querySelectorAll('input[type="checkbox"]:not(#select_all_submodules)');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    document.getElementById("assignModuleForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        fetch("{{ route('dashboard.usermodules.syncModules') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                "X-Requested-With": "XMLHttpRequest"
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            closeModuleModal();
        })
        .catch(err => console.error(err));
    });
});
</script>

<!-- Modal: Asignar Módulo a Usuario -->
<div id="modalAssignModule" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModuleModal()">&times;</span>
        <h3>Asignar Módulo a Usuario</h3>
        <form id="assignModuleForm">
            @csrf
            <input type="hidden" id="assign_user_id" name="user_id">

            <label for="assign_module_id">Módulo:</label>
            <select id="assign_module_id" name="module_id" required>
                <option value="">Selecciona un módulo</option>
                @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>

            <div id="submodule-checkboxes" style="margin-top: 15px;">
                <label>Submódulos:</label>
                <div class="checkbox-item">
                    <label>
                        <input type="checkbox" id="select_all_submodules"> Todos
                    </label>
                </div>
                <div id="submodule_list" class="submodule-list">
                    <!-- Checkboxes dinámicos aquí -->
                </div>
            </div>

            <button type="submit">Asignar</button>
        </form>
    </div>
</div>

<!-- Estilos internos -->
<style>
#modalAssignModule .modal-content {
    background: white;
    padding: 20px;
    width: 400px;
    border-radius: 10px;
    margin: auto;
    position: relative;
}
#modalAssignModule select,
#modalAssignModule button {
    display: block;
    width: 100%;
    margin-bottom: 15px;
}

.submodule-list {
    margin-top: 10px;
}

.checkbox-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
}

.checkbox-item label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    cursor: pointer;
}

.checkbox-item input[type="checkbox"] {
    transform: scale(1.1);
    cursor: pointer;
}
</style>