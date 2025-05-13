@extends('dashboard') 
@section('content')
<div class="container-users">
    <div class="navbar">
        <div class="navbar-header-title">
            <img src="{{ asset('icon/users-white.svg') }}" class="submenu-icon-area">
            <h2 class="navbar-title">Usuarios</h2>
        </div>

        <div class="navbar-filters">
            <!-- Filtro por Categoría -->
            <select id="filter-category" class="filter-select">
                <option value="">Filtrar por...</option>
                <option value="name">Nombre</option>
                <option value="email">Email</option>
            </select>

            <!-- Input de Búsqueda -->
            <input type="text" id="search-input" class="search-box" placeholder="Buscar usuario...">
            
            <!-- Botón de Búsqueda -->
            <button class="search-btn" onclick="searchAreas()">🔍</button>
        </div>
    </div>

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de Áreas -->
     <div class="content-users">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="action-icons">
                            <a href="#" class="btn-icon" onclick="openEditModal({{ $user->id }})">
                                <img src="{{ asset('icon/edit.svg') }}" alt="Editar">
                            </a>
                            <a href="#" class="btn-icon" onclick="deleteArea({{ $user->id }})">
                                <img src="{{ asset('icon/destroy.svg') }}" alt="Eliminar">
                            </a>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="#" class="btn-icon" title="Asignar Módulos" onclick="openModuleModal({{ $user->id }})">
                                <img src="{{ asset('icon/module.svg') }}" alt="Asignar Módulo">
                            </a>
                            <a href="#" class="btn-icon" title="Gestionar Permisos" onclick="openPermissionModal({{ $user->id }})">
                                <img src="{{ asset('icon/permissions.svg') }}" alt="Permisos">
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $users->links('vendor.pagination.default') }}
        </div>
     </div>
</div>

@include('components.modals.Users.assign-module')
@include('components.modals.Users.assign-permissions')

<!-- Modal -->
<div id="modalCreateArea" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <h2>Agregar Nuevo Usuario</h2>
        <form id="createUserForm">
            @csrf
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>

            <label for="shortname">Email:</label>
            <input type="email" id="shortname" name="shortname" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn-submit">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal de Edición -->
<div id="modalEditUser" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" onclick="closeEditModal()">&times;</span>
        <h2>Editar Usuario</h2>
        
        <form id="editAreaForm" class="modal-form">
            @csrf
            @method('PUT') <!-- Método para actualizar -->
            
            <input type="hidden" id="edit_id" name="id"> <!-- ID oculto para enviar -->

            <div class="modal-field">
                <label for="edit_name">Nombre:</label>
                <input type="text" id="edit_name" name="name" required>
            </div>

            <div class="modal-field">
                <label for="edit_email">Email:</label>
                <input type="text" id="edit_email" name="email" required>
            </div>

            <button type="submit" class="btn-submit">Guardar Cambios</button>
        </form>
    </div>
</div>

<!-- Botón flotante para agregar nueva área -->
<a href="#" class="btn-floating" onclick="openModal()">+</a>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById('search-input');
    let filterSelect = document.getElementById('filter-category');

    // Función para eliminar caracteres especiales (tildes, ñ, etc.)
    function normalizeText(text) {
        return text.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // Remueve tildes y caracteres especiales
    }

    function searchAreas() {
        let searchValue = searchInput.value.toLowerCase().trim();
        let filterValue = filterSelect.value;
        let rows = document.querySelectorAll('.styled-table tbody tr');

        let normalizedSearch = normalizeText(searchValue);

        rows.forEach(row => {
            let areaName = normalizeText(row.cells[1].innerText.toLowerCase()); // Nombre sin tildes
            let shortName = normalizeText(row.cells[2].innerText.toLowerCase()); // Abreviatura sin tildes
            let matchSearch = false;

            // Si no hay filtro, busca en ambos campos automáticamente al escribir
            if (filterValue === "") {
                matchSearch = areaName.includes(normalizedSearch) || shortName.includes(normalizedSearch);
            } else if (filterValue === "name") {
                matchSearch = areaName.includes(normalizedSearch);
            } else if (filterValue === "shortname") {
                matchSearch = shortName.includes(normalizedSearch);
            }

            // Mostrar u ocultar filas según la búsqueda
            row.style.display = matchSearch ? "" : "none";
        });
    }

    // Ejecutar búsqueda automáticamente al escribir si NO hay filtro seleccionado
    searchInput.addEventListener("keyup", function () {
        if (filterSelect.value === "") {
            searchAreas();
        }
    });

    // Ejecutar búsqueda solo con el botón cuando hay un filtro seleccionado
    document.querySelector(".search-btn").addEventListener("click", function () {
        searchAreas();
    });
});

function openModal() {
    document.getElementById('modalCreateArea').style.display = 'flex';
}

/* Modal */
function closeModal() {
    document.getElementById('modalCreateArea').style.display = 'none';
}

document.getElementById("createAreaForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Evitar recarga de la página

    let formData = new FormData(this);

    fetch("{{ route('dashboard.users.store') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest", // Indicar que es AJAX
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la respuesta del servidor");
        }
        return response.json(); // Convertir la respuesta a JSON
    })
    .then(data => {
        if (data.message) {
            alert(data.message);
            closeModal();
            location.reload(); // Refrescar la tabla sin salir de la página
        } else {
            alert("Error al crear el usuario");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Hubo un problema al crear el usuario.");
    });
});

/* Update */
function openEditModal(areaId) {
    fetch(`/dashboard/users/${areaId}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('modalEditUser').style.display = 'flex';
        })
        .catch(error => console.error("Error al cargar datos:", error));
}

function closeEditModal() {
    document.getElementById('modalEditUser').style.display = 'none';
}

document.getElementById("editAreaForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Evita la recarga de la página

    let formData = new FormData(this);
    let areaId = document.getElementById('edit_id').value;

    fetch(`/dashboard/users/${areaId}`, {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la respuesta del servidor");
        }
        return response.json();
    })
    .then(data => {
        alert("Usuario actualizada con éxito");
        closeEditModal();
        location.reload();
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Hubo un problema al actualizar el usuario.");
    });
});

/* Delete */
function deleteArea(areaId) {
    if (!confirm('¿Seguro que quieres eliminar este usuario?')) return;

    fetch(`/dashboard/users/${areaId}`, {
        method: "DELETE",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error al eliminar el usuario");
        }
        return response.json();
    })
    .then(data => {
        alert("Usuario eliminado con éxito");
        location.reload();
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Hubo un problema al eliminar el usuario.");
    });
}
</script>

@endsection

<style>
/* Ajuste dinámico de la navbar */
.navbar {
    position: fixed;
    top: 0;
    left: 0; /* Ajustamos a la izquierda para que no se desborde */
    min-width: 100%; /* Ocupará todo el ancho */
    background-color: var(--govco-secondary-color);
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1000;
    transition: all 0.3s ease-in-out;
}

.navbar-header-title {
    display: flex;
    align-items: center; /* Centrar verticalmente */
    gap: 10px; /* Espacio entre el icono y el texto */
}

.submenu-icon-area {
    width: 30px; /* Ajusta el tamaño del icono */
    height: 30px;
    color: white;
}


/* Ajustar el contenedor para que no se solape con la navbar */
.container-users {
    min-width: 100%;
    min-height: 100%;
}

.content-users {
    margin: 1.5rem;
}

.navbar-title {
    color: var(--govco-white-color);
    font-family: var(--govco-font-primary);
    font-size: 20px;
    font-weight: bold;
}

/* Contenedor de filtros */
.navbar-filters {
    display: flex;
    gap: 10px;
    align-items: center;
}

/* Estilo del Select */
.filter-select {
    padding: 8px;
    border-radius: var(--govco-border-radius);
    border: 1px solid var(--govco-border-color);
    font-family: var(--govco-font-primary);
}

/* Estilo del Input de Búsqueda */
.search-box {
    padding: 8px;
    border-radius: var(--govco-border-radius);
    border: 1px solid var(--govco-border-color);
    font-family: var(--govco-font-primary);
}

/* Estilo del Botón de Búsqueda */
.search-btn {
    padding: 8px 12px;
    border: none;
    background-color: var(--govco-accent-color);
    color: var(--govco-white-color);
    border-radius: var(--govco-border-radius);
    cursor: pointer;
}

.search-btn:hover {
    background-color: var(--govco-primary-color);
}

.title {
    color: var(--govco-primary-color);
    font-family: var(--govco-font-primary);
    margin-bottom: 20px;
}

/* Alertas */
.alert-success {
    background-color: var(--govco-success-color);
    color: var(--govco-white-color);
    padding: 10px;
    border-radius: var(--govco-border-radius);
    margin-bottom: 15px;
}

/* Tabla */
.styled-table {
    width: 100%;
    border-collapse: collapse;
    background: var(--govco-white-color);
    border: 1px solid var(--govco-border-color);
}

.styled-table thead tr {
    text-align: center;
}

.styled-table thead th {
    text-align: center;
    vertical-align: middle;
}

.styled-table th, .styled-table td {
    border: 1px solid var(--govco-border-color);
    padding: 10px;
    text-align: left;
}

.styled-table th {
    background: var(--govco-secondary-color);
    color: var(--govco-white-color);
    font-family: var(--govco-font-primary);
}

.styled-table tr:nth-child(even) {
    background: var(--govco-gray-color);
}

.action-icons {
    display: flex;
    align-items: center;
    gap: 10px; /* Espacio entre iconos */
}

.btn-icon img {
    width: 24px;
    height: 24px;
    cursor: pointer;
    transition: transform 0.2s ease-in-out;
}

.btn-icon img:hover {
    transform: scale(1.1);
}

/* Botón flotante */
.btn-floating {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: var(--govco-accent-color);
    color: var(--govco-white-color);
    font-size: 24px;
    width: 50px;
    height: 50px;
    text-align: center;
    line-height: 50px;
    border-radius: 50%;
    text-decoration: none;
    box-shadow: var(--govco-box-shadow);
}

.btn-floating:hover {
    background-color: var(--govco-secondary-color);
    color: white
}
</style>