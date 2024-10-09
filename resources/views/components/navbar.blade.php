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

    /* Contenedor principal del navbar */
    .navbar-bottom {
        background-color: var(--govco-gray-color);
        padding: 1rem 2rem;
        border-top: 1px solid var(--govco-border-color);
        font-family: var(--govco-font-primary);
    }

    /* Estilos para el contenedor de enlaces */
    .nav-links {
        display: flex;
        justify-content: center;
        gap: 2rem;
    }

    /* Estilo de cada enlace del menú principal */
    .menu-item {
        position: relative;
        display: inline-block;
    }

    /* Estilos para los enlaces de menú */
    .menu-item > a {
        color: var(--govco-secondary-color);
        font-size: 0.95rem;
        font-weight: 500;
        text-decoration: none;
        padding-bottom: 0.5rem;
        transition: color 0.3s ease;
    }

    /* Efecto hover en los enlaces de menú */
    .menu-item > a:hover {
        color: var(--govco-highlight-color);
    }

    /* Estilos para el contenedor de submenús */
    .submenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: var(--govco-white-color);
        border: 1px solid var(--govco-border-color);
        border-radius: 5px;
        padding: 0.5rem 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }

    /* Estilos para los enlaces de submenús */
    .submenu a {
        display: block;
        padding: 0.5rem 1rem;
        color: var(--govco-primary-color);
        text-decoration: none;
        font-size: 0.9rem;
    }

    /* Efecto hover en los enlaces de submenús */
    .submenu a:hover {
        background-color: var(--govco-gray-color);
        color: var(--govco-highlight-color);
    }

    /* Mostrar el submenú al pasar el mouse sobre el elemento del menú principal */
    .menu-item:hover .submenu {
        display: block;
    }

    /* Responsive: alineación vertical en pantallas pequeñas */
    @media (max-width: 768px) {
        .nav-links {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        
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
    
    <div class="search-bar">
        <input type="text" placeholder="{{ __('navbar.search_placeholder') }}">
        <button type="submit">
            <img src="/icons/search-icon.svg" alt="{{ __('navbar.search_placeholder') }}" width="16" height="16">
        </button>
    </div>
    <div>
        <a href="{{ route('login') }}" class="login-btn">{{ __('navbar.login') }}</a>
    </div>
</nav>

<div class="navbar-bottom">
    <div id="nav-links" class="nav-links"></div>
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

    window.addEventListener('load', function() {
        // Verifica que `api` esté definido y accesible
        if (typeof api !== 'undefined') {
            api.get('/menu')
                .then(response => {
                    const menus = response.data;
                    const navLinks = document.getElementById('nav-links');
                    
                    // Itera sobre los elementos del menú y los agrega al DOM
                    menus.forEach(menu => {
                        let menuItem = document.createElement('div');
                        menuItem.classList.add('menu-item');
                        
                        let menuLink = document.createElement('a');
                        menuLink.href = menu.route;
                        menuLink.textContent = menu.name;
                        menuItem.appendChild(menuLink);

                        if (menu.submenus && menu.submenus.length > 0) {
                            let submenu = document.createElement('div');
                            submenu.classList.add('submenu');
                            
                            menu.submenus.forEach(sub => {
                                let subLink = document.createElement('a');
                                subLink.href = sub.route;
                                subLink.textContent = sub.name;
                                submenu.appendChild(subLink);
                            });
                            
                            menuItem.appendChild(submenu);
                        }
                        
                        navLinks.appendChild(menuItem);
                    });
                })
                .catch(error => {
                    console.error('Error al cargar el menú:', error);
                });
        } else {
            console.error('Error: `api` no está definido');
        }
    });
</script>