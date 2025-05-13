<div class="sidebar" id="sidebar">
    <div class="sidebar-inner">
        <!-- Botón para minimizar la sidebar (se mantiene fijo a la derecha) -->
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="-5 -7 24 24">
                <path fill="#004085" d="M1 0h5a1 1 0 1 1 0 2H1a1 1 0 1 1 0-2m7 8h5a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2M1 4h12a1 1 0 0 1 0 2H1a1 1 0 1 1 0-2"/>
            </svg>
        </button>

        <!-- Header con el nombre del usuario -->
        <div class="sidebar-header">
            <h2>Dashboard</h2>
            @auth
                <p>Bienvenido, {{ Auth::user()->name }}</p>
            @endauth
        </div>

        <!-- Menú de navegación -->
        <nav class="sidebar-menu">
            <ul>
                @foreach ($modules as $module)
                    <li class="menu-item">
                        @if ($module->route) 
                            <a href="{{ route($module->route) }}">
                        @else 
                            <a href="#" onclick="toggleSubmenu(event, '{{ $module->id }}')">
                        @endif
                                <img src="{{ asset('icon/' . $module->icon) }}" alt="{{ $module->name }} Icono" class="menu-icon">
                                <span class="menu-text">{{ $module->name }}</span>
                                @if ($module->submodules->count() > 0)
                                    <svg id="toggle-icon-{{ $module->id }}" class="toggle-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                        <path fill="#003B70" d="M6 9l6 6 6-6z"></path>
                                    </svg>
                                @endif
                            </a>

                        @if ($module->submodules->count() > 0)
                            <ul class="submenu" id="submenu-{{ $module->id }}" style="display: none;">
                                @foreach ($module->submodules as $submodule)
                                    <li>
                                        <a href="{{ route($submodule->route) }}">
                                            <img src="{{ asset('icon/' . $submodule->icon) }}" alt="{{ $submodule->name }} Icono" class="submenu-icon">
                                            <span class="submenu-text">{{ $submodule->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Logout Fijo Abajo -->
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="#004085" d="M15 2h-1c-2.828 0-4.243 0-5.121.879C8 3.757 8 5.172 8 8v8c0 2.828 0 4.243.879 5.121C9.757 22 11.172 22 14 22h1c2.828 0 4.243 0 5.121-.879C21 20.243 21 18.828 21 16V8c0-2.828 0-4.243-.879-5.121C19.243 2 17.828 2 15 2" opacity=".6"/>
                        <path fill="#004085" d="M8 8c0-1.538 0-2.657.141-3.5H8c-2.357 0-3.536 0-4.268.732S3 7.143 3 9.5v5c0 2.357 0 3.535.732 4.268S5.643 19.5 8 19.5h.141C8 18.657 8 17.538 8 16z" opacity=".4"/>
                        <path fill="#004085" fill-rule="evenodd" d="M4.47 11.47a.75.75 0 0 0 0 1.06l2 2a.75.75 0 0 0 1.06-1.06l-.72-.72H14a.75.75 0 0 0 0-1.5H6.81l.72-.72a.75.75 0 1 0-1.06-1.06z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("collapsed");
}

function toggleSubmenu(event, moduleId) {
    event.preventDefault();
    let submenu = document.getElementById('submenu-' + moduleId);
    if (submenu) {
        submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
    }
}
</script>

<!-- <script>
function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("collapsed");

    // Ocultar todos los submódulos cuando la sidebar está colapsada
    if (sidebar.classList.contains("collapsed")) {
        document.querySelectorAll(".submenu").forEach(submenu => {
            submenu.style.display = "none";
        });
    }
}
</script> -->

<style>
/* Contenedor principal */
#container {
    display: flex;
    min-height: 100vh;
    overflow: hidden;
}

/* Sidebar */
.sidebar {
    width: 260px;
    background-color: #ffffff;
    color: #003B70;
    transition: width 0.3s ease-in-out;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    border-right: 3px solid #dcdcdc; /* Borde para diferenciar del contenido */
    box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
    position: relative;
}

.sidebar-inner {
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Sidebar cuando está colapsado */
.sidebar.collapsed {
    width: 80px;
}

/* Mantener el botón en la misma posición */
.sidebar-toggle {
    position: absolute;
    top: 5px;
    right: 5px; /* Se mantiene a la derecha */
    background: none;
    border: none;
    font-size: 1.2rem;
    color: #003B70;
    cursor: pointer;
    transition: all 0.3s;
}

/* Header */
.sidebar-header {
    padding: 1rem;
    background-color: #E5E5E5;
    text-align: center;
    border-bottom: 2px solid #dcdcdc;
}

.sidebar-header h2 {
    font-size: 1.4rem;
    margin: 0;
    color: #003B70;
    font-weight: bold;
}

.sidebar-header p {
    font-size: 0.9rem;
    margin-top: 0.5rem;
    color: #555;
}

/* Ocultar header cuando sidebar está colapsado */
.sidebar.collapsed .sidebar-header h2,
.sidebar.collapsed .sidebar-header p {
    display: none;
}

/* Menú */
.sidebar-menu {
    flex: 1;
    padding-top: 1rem;
}

.sidebar-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu ul li a {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: #003B70;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 600;
    transition: background 0.3s ease-in-out;
    border-radius: 5px;
}

.sidebar-menu ul li a:hover {
    background-color: #D9E6F2;
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.1);
}

/* Íconos */
.sidebar-menu ul li a svg {
    min-width: 25px;
    margin-right: 10px;
}

/* Texto del menú */
.menu-text {
    margin-left: 0.5rem;
}

/* Footer con botón de logout fijo abajo */
.sidebar-footer {
    border-top: 2px solid #dcdcdc;
    text-align: center;
    background: #f8f9fa;
    margin-top: auto; /* Mantiene el footer abajo */
}

.menu-icon {
    width: 24px; /* Tamaño uniforme */
    height: 24px;
    margin-right: 8px; /* Espaciado entre icono y texto */
}

/* Submenús */
.submenu {
    display: none; /* Ocultos por defecto */
    padding-left: 20px; /* Indentación para diferenciar */
}

.submenu li {
    margin-left: 15px; /* Desplazar más a la derecha */
}

/* Botón de expandir */
.expand-toggle {
    cursor: pointer;
    background: none;
    border: none;
    color: #003B70;
    font-size: 0.9rem;
    margin-left: auto;
}

.expand-toggle:hover {
    color: #002147;
}

/* Mostrar submenús cuando estén activos */
.menu-item.active .submenu {
    display: block;
}

/* Ocultar la flecha por defecto */
.sidebar-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Ícono de toggle */
.toggle-icon {
    transition: transform 0.3s ease-in-out;
    margin-left: auto; /* Alinea la flecha a la derecha */
}

/* Rotar flecha cuando está expandido */
.menu-item.active .toggle-icon {
    transform: rotate(180deg);
}

/* Ocultar la flecha por defecto */
.sidebar-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Ocultar texto del menú cuando la sidebar está colapsada */
.sidebar.collapsed .menu-text {
    display: none;
}

/* Centrar íconos cuando la sidebar está colapsada */
.sidebar.collapsed .sidebar-menu ul li a,
.sidebar.collapsed .logout-button {
    justify-content: center;
}

/* Ocultar el indicador de expandir cuando la sidebar está colapsada */
.sidebar.collapsed .toggle-icon {
    display: none;
}

/* Contraer submódulos cuando la sidebar está colapsada */
.sidebar.collapsed .submenu {
    display: none !important;
}

.logout-button {
    width: 100%;
    background: none;
    border: none;
    color: #003B70;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0.75rem 1rem;
    transition: background 0.3s;
}

.logout-button svg {
    margin: 0 auto;
}

.logout-button:hover {
    background-color: #D9E6F2;
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 80px;
    }

    .sidebar.collapsed {
        width: 60px;
    }

    #main-content {
        margin-left: 80px;
    }
}
</style>