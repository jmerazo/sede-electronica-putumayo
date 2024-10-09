<style>
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

    .navbar-top .actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .navbar-top .login-btn, .navbar-top .lang-btn {
        color: var(--govco-white-color);
        background-color: transparent;
        border: none;
        font-size: 0.9rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .navbar-top .login-btn:hover, .navbar-top .lang-btn:hover {
        color: var(--govco-highlight-color);
    }

    /* Estilos de la barra de navegación principal */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: var(--govco-white-color);
        border-bottom: 1px solid var(--govco-gray-color);
        font-family: var(--govco-font-family);
    }

    .navbar .logo img {
        max-width: 100px;
        height: auto;
    }

    .nav-links {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        font-size: 0.95rem;
    }

    .nav-links a {
        color: var(--govco-primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-links a:hover {
        color: var(--govco-highlight-color);
    }

    /* Botón de búsqueda */
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

    /* Estilo del área del login */
    .login-btn {
        color: var(--govco-primary-color);
        text-decoration: none;
        font-size: 0.9rem;
    }

    .login-btn:hover {
        color: var(--govco-highlight-color);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: center;
        }

        .nav-links {
            flex-direction: column;
            gap: 0.8rem;
            margin-top: 0.5rem;
        }

        .search-bar {
            margin-top: 1rem;
        }
    }

    /* Estilos para el menú de navegación inferior */
    .navbar-bottom {
        background-color: var(--govco-gray-color);
        padding: 1rem 2rem;
        border-top: 1px solid var(--govco-border-color);
        font-family: var(--govco-font-primary);
    }

    .navbar-bottom .nav-links {
        display: flex;
        justify-content: center;
        gap: 2rem;
    }

    .navbar-bottom .nav-links a {
        color: var(--govco-secondary-color);
        font-size: 0.95rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s ease, border-bottom 0.3s ease;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .navbar-bottom .nav-links a:hover {
        color: var(--govco-highlight-color);
    }

    .navbar-bottom .nav-links a::after {
        content: "";
        display: block;
        width: 0;
        height: 2px;
        background: var(--govco-highlight-color);
        transition: width 0.3s;
        margin: 0 auto;
        position: absolute;
        left: 0;
        bottom: 0;
        right: 0;
    }

    .navbar-bottom .nav-links a:hover::after {
        width: 100%;
    }

    /* Responsive: para pantallas pequeñas */
    @media (max-width: 768px) {
        .navbar-bottom .nav-links {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
    }
</style>

<div class="navbar-top">
    <!-- Logo de GOV.CO -->
    <div class="govco-logo">
        <a href="https://www.gov.co" target="_blank">
            <img src="/logos/logo_govco.png" alt="Logo GOV.CO">
        </a>
    </div>

    <div class="actions">
        <!-- Botón de cambio de idioma -->
        <button id="lang-toggle" class="lang-btn" onclick="toggleLanguage()">
            {{ App::getLocale() === 'es' ? 'EN' : 'ES' }}
        </button>
    </div>
</div>

<nav class="navbar">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="/logos/logo_gobernacion_min.png" alt="Gobernación del Putumayo">
        </a>
    </div>
    
    <div class="search-bar">
        <input type="text" placeholder="Buscar...">
        <button type="submit">
            <img src="/icons/search-icon.svg" alt="Buscar" width="16" height="16">
        </button>
    </div>
    <div>
        <a href="{{ route('login') }}" class="login-btn">Iniciar Sesión</a>
    </div>
</nav>

<div class="navbar-bottom">
    <div class="nav-links">
        <a href="#home">Inicio</a>
        <a href="{{ route('transparencia') }}">Transparencia y Acceso Información Pública</a>
        <a href="#services">Atención y Servicios a la Ciudadanía</a>
        <a href="#tramites">Trámites y Servicios</a>
        <a href="#participa">Participa</a>
        <a href="#normatividad">Normatividad</a>
    </div>
</div>

<script>
    function toggleLanguage() {
        // Detecta el idioma actual
        const currentLang = '{{ App::getLocale() }}';
        
        // Redirige al idioma opuesto
        let newLang = currentLang === 'es' ? 'en' : 'es';
        
        // Redirecciona a la ruta para cambiar el idioma
        window.location.href = `/set-locale/${newLang}`;
    }
</script>