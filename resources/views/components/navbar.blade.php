<style>
/* Contenedor principal de la navbar */
.navbar-container {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    background-color: var(--govco-secondary-color);
}

/* Estilos para la parte superior de la barra de navegación */
.navbar-top {
    background-color: var(--govco-secondary-color);
    color: var(--govco-white-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 2rem;
    font-family: var(--govco-font-primary);
}

.navbar-top .govco-logo {
    display: flex;
    align-items: center;
}

.navbar-top .govco-logo img {
    max-height: 30px;
    margin-right: 1rem;
}

.navbar-top .lang-btn {
    color: var(--govco-white-color);
    background-color: transparent;
    border: none;
    font-size: 0.9rem;
    cursor: pointer;
    transition: color 0.3s ease;
}

.navbar-top .lang-btn:hover {
    color: var(--govco-secondary-color);
    background-color: var(--govco-white-color);
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: var(--govco-white-color);
    border-bottom: 1px solid var(--govco-gray-color);
    font-family: var(--govco-font-family);
}

.logo {
    flex: 1;
}

.search__login {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex: 1;
    justify-content: flex-end;
}

.search-bar {
    display: flex;
    align-items: center;
    border: 1px solid var(--govco-gray-color);
    border-radius: 4px;
    padding: 0.3rem 0.5rem;
}

.search-bar input {
    border: none;
    outline: none;
    font-size: 0.9rem;
    padding: 0.3rem;
}

.search-bar button {
    background-color: transparent;
    border: none;
    color: var(--govco-primary-color);
    cursor: pointer;
}

.search-bar button:hover {
    color: var(--govco-highlight-color);
}

.navbar__login {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.login__btn {
    color: var(--govco-white-color);
    text-decoration: none;
    font-size: 0.9rem;
    background-color: var(--govco-secondary-color);
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.login__btn:hover {
    background-color: var(--govco-primary-color);
    color: var(--govco-white-color);
}

.navbar .logo img {
    max-width: 200px;
    height: auto;
}

.btn__login {
    background-color: var(--govco-secondary-color);
    color: var(--govco-white-color);
}

/* Estilo del área del login */
.login-btn {
    color: var(--govco-primary-color);
    text-decoration: none;
    font-size: 0.9rem;
}

.navbar-bottom {
    background-color: var(--govco-gray-menu);
    padding: 0; /* Ajuste según el diseño */
    font-family: var(--govco-font-primary);
}

.nav-links {
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.menu-item {
    position: relative;
    display: flex;
    align-items: center;
    height: 100%;
    padding: 0 1rem;
    transition: background-color 0.3s ease;
}

/* Estilo del enlace dentro del contenedor del menú */
.menu-item > a {
    color: var(-govco-secondary-color);
    text-decoration: none;
    font-weight: 700;
    font-family: var(--govco-font-primary);
    font-size: 0.8rem;
    padding: 1rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%; /* Asegura que el enlace ocupe todo el alto */
    width: 100%;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Cambiar el fondo y color del texto cuando se pasa el ratón sobre el contenedor */
.menu-item:hover {
    background-color: var(--govco-secondary-color);
}

.menu-item:hover > a {
    color: var(--govco-white-color);
}

/* Estilo del submenú */
.submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: var(--govco-gray-menu);
    border: 1px solid var(--govco-border-color);
    border-radius: var(--govco-border-radius);
    padding: 0.5rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 10;
}

.submenu a {
    display: block;
    padding: 0.5rem 1rem;
    background-color: var(--govco-gray-menu);
    font-family: var(--govco-font-primary);
    text-decoration: none;
    font-size: 0.9rem;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.submenu a:hover {
    background-color: var(--govco-secondary-color); /* Color del fondo al pasar el ratón */
    color: var(--govco-white-color); /* Cambiar el color del texto */
    padding: 0.5rem 1rem; /* Asegura que el relleno cubra todo el área */
}


.menu-item:hover .submenu {
    display: block;
}

/* Responsivo: submenú en modo stack en pantallas pequeñas */
@media (max-width: 768px) {
    .submenu {
        position: static;
        box-shadow: none;
        border: none;
        background-color: transparent;
    }

    .submenu a {
        padding: 0.5rem 0;
    }
}

.menu-item.selected {
    border: 2px solid var(--govco-success-color);
    border-radius: 4px; /* Opcional: añade esquinas redondeadas */
    box-sizing: border-box; /* Asegura que el borde no afecte el tamaño del elemento */
}

/* Compensar la altura de la navbar completa en el contenedor principal */
body {
    padding-top: 135px; /* Ajusta según la altura total de navbar-top + navbar + navbar-bottom */
}
</style>

<header class="navbar-container">
    <div class="navbar-top">
        <!-- Logo de GOV.CO -->
        <div class="govco-logo">
            <a href="https://www.gov.co" target="_blank">
                <img src="/logos/logo_govco.png" alt="Logo GOV.CO">
            </a>
        </div>
        <div class="actions">
            <button id="lang-toggle" class="lang-btn" onclick="toggleLanguage()">
                {{ __('navbar.language') }}
            </button>
        </div>
    </div>

    <nav class="navbar">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="/logos/logo_gobernacion_min.png" alt="Gobernación del Putumayo">
            </a>
        </div>
        <div class="search__login">
            <div class="search-bar">
                <input type="text" placeholder="{{ __('navbar.search_placeholder') }}">
                <button type="submit">
                    <img src="/icons/search.svg" alt="{{ __('navbar.search_placeholder') }}" width="16" height="16">
                </button>
            </div>
            <div class="navbar__login">
                <a href="{{ route('login') }}" class="login__btn">{{ __('navbar.login') }}</a>
            </div>
        </div>
    </nav>

    <div class="navbar-bottom">
        <div class="nav-links">
            @foreach ($menus as $menu)
                <div class="menu-item {{ request()->is($menu->route) ? 'selected' : '' }}">
                    <a href="{{ url($menu->route) }}">{{ $menu->name }}</a>

                    @if ($menu->submenus->isNotEmpty())
                        <div class="submenu">
                            @foreach ($menu->submenus as $submenu)
                                <a href="{{ url($submenu->route) }}">{{ $submenu->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</header>