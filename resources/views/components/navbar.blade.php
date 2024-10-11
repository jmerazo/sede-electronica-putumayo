<style>
    .navbar-top {
        background-color: var(--govco-secondary-color); /* Define el color de fondo usando la variable de color secundario de GOV.CO */    
        color: var(--govco-white-color); /* Establece el color del texto en blanco usando la variable de color blanco de GOV.CO */    
        display: flex; /* Utiliza Flexbox para organizar los elementos en una fila horizontal */
        justify-content: space-between; /* Distribuye los elementos a los extremos, dejando espacio entre ellos */    
        align-items: center; /* Centra verticalmente los elementos dentro del contenedor */   
        padding: 0.5rem 2rem; /* Agrega espacio interno de 0.5 rem en la parte superior e inferior, y 2 rem en los lados */   
        font-family: var(--govco-font-primary); /* Aplica la fuente principal de GOV.CO a todo el contenido dentro de .navbar-top */
    }

        .navbar-top .govco-logo {
        display: flex; /* Organiza el contenido en una fila */
        align-items: center; /* Centra verticalmente los elementos dentro del contenedor */
    }

    .navbar-top .govco-logo img {
        max-height: 30px; /* Establece una altura máxima para la imagen */
        margin-right: 1rem; /* Agrega un margen derecho de 1rem */
    }

    .navbar-top .actions {
        display: flex; /* Organiza los elementos en una fila */
        align-items: center; /* Centra verticalmente los elementos */
        gap: 1rem; /* Añade un espacio de 1rem entre los elementos */
    }

    .navbar-top .login-btn, .navbar-top .lang-btn {
        color: var(--govco-white-color); /* Aplica color blanco al texto */
        background-color: transparent; /* Fondo transparente */
        border: none; /* Sin borde */
        font-size: 0.9rem; /* Tamaño de fuente de 0.9rem */
        cursor: pointer; /* Cambia el cursor a puntero (mano) */
        transition: color 0.3s ease; /* Transición suave en el color al hacer hover */
    }

    .navbar-top .login-btn:hover, .navbar-top .lang-btn:hover {
        color: var(--govco-highlight-color); /* Cambia el color al hacer hover */
    }

    /* Estilos de la barra de navegación principal */
    .navbar {
        display: flex; /* Organiza los elementos en una fila */
        justify-content: space-between; /* Distribuye el espacio entre los elementos */
        align-items: center; /* Centra verticalmente los elementos */
        padding: 1rem 2rem; /* Espacio interno de 1rem arriba/abajo y 2rem a los lados */
        background-color: var(--govco-white-color); /* Fondo blanco */
        border-bottom: 1px solid var(--govco-gray-color); /* Borde inferior gris */
        font-family: var(--govco-font-family); /* Aplica la fuente definida en la variable */
    }

    .navbar .logo img {
        max-width: 250px; /* Anchura máxima de la imagen */
        height: auto; /* Altura automática para mantener la proporción */
    }

    .nav-links {
        display: flex; /* Organiza los enlaces en una fila */
        justify-content: center; /* Centra los enlaces horizontalmente */
        gap: 1.5rem; /* Espacio de 1.5rem entre los enlaces */
        font-size: 0.95rem; /* Tamaño de fuente para los enlaces */
    }

    .nav-links a {
        color: var(--govco-primary-color); /* Color del enlace */
        text-decoration: none; /* Elimina el subrayado del enlace */
        font-weight: 500; /* Peso de fuente medio */
        transition: color 0.3s ease; /* Transición suave al cambiar el color */
    }

    .nav-links a:hover {
        color: var(--govco-tertiary-color); /* Cambia el color del enlace al hacer hover */
    }

    /* Botón de búsqueda */
    .search-bar {
        display: flex; /* Organiza los elementos en una fila */
        align-items: center; /* Centra verticalmente los elementos */
        border: 1px solid var(--govco-gray-color); /* Borde gris alrededor */
        border-radius: 4px; /* Bordes redondeados */
        padding: 0.3rem 0.5rem; /* Espaciado interno de 0.3rem arriba/abajo y 0.5rem a los lados */
    }

    .search-bar input {
        border: none; /* Sin borde */
        outline: none; /* Sin contorno */
        font-size: 0.9rem; /* Tamaño de fuente */
        padding: 0.3rem; /* Espaciado interno */
    }

    .search-bar button {
        background-color: transparent; /* Fondo transparente */
        border: none; /* Sin borde */
        color: var(--govco-primary-color); /* Color del icono */
        cursor: pointer; /* Cambia el cursor a puntero */
    }

    .search-bar button:hover {
        color: var(--govco-white-color); /* Cambia el color al hacer hover */
    }

    /* Estilo del área del login */
    .login-btn {
        color: var(--govco-primary-color); /* Color del texto */
        text-decoration: none; /* Sin subrayado */
        font-size: 0.9rem; /* Tamaño de fuente */
    }

    .login-btn:hover {
        color: var(--govco-gray-color); /* Cambia el color del enlace al hacer hover */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column; /* Apila los elementos verticalmente */
            align-items: center; /* Centra los elementos en el medio */
        }

        .nav-links {
            flex-direction: column; /* Coloca los enlaces en columna */
            gap: 0.8rem; /* Espacio de 0.8rem entre enlaces */
            margin-top: 0.5rem; /* Margen superior de 0.5rem */
        }

        .search-bar {
            margin-top: 1rem; /* Añade margen superior de 1rem */
        }
    }

    /* Contenedor principal del navbar */
    .navbar-bottom {
        background-color: var(--govco-gray-color); /* Fondo gris */
        padding: 1rem 2rem; /* Espacio interno de 1rem arriba/abajo y 2rem a los lados */
        border-top: 1px solid var(--govco-border-color); /* Borde superior */
        font-family: var(--govco-font-primary); /* Fuente principal */
    }

    /* Estilos para el contenedor de enlaces */
    .nav-links {
        display: flex; /* Organiza los enlaces en una fila */
        justify-content: center; /* Centra los enlaces */
        gap: 2rem; /* Espacio de 2rem entre enlaces */
    }

    /* Estilo de cada enlace del menú principal */
    .menu-item {
        position: relative; /* Posiciona el elemento relativo para submenús */
        display: inline-block; /* Los elementos son en línea y bloque */
    }

    /* Estilos para los enlaces de menú */
    .menu-item > a {
        color: var(--govco-tertiary-color); /* Color del texto */
        font-size: 0.95rem; /* Tamaño de fuente */
        font-weight: 500; /* Peso de fuente medio */
        text-decoration: none; /* Sin subrayado */
        padding-bottom: 0.5rem; /* Espacio inferior */
        transition: color 0.3s ease; /* Transición suave para el color */
    }

    /* Efecto hover en los enlaces de menú */
    .menu-item > a:hover {
        color: var(--govco-secondary-color); /* Cambia el color al hacer hover */
    }

    /* Estilos para el contenedor de submenús */
    .submenu {
        display: none; /* Oculta el submenú por defecto */
        position: absolute; /* Posiciona el submenú relativo al menú */
        top: 100%; /* Coloca el submenú debajo del menú principal */
        left: 0; /* Alinea a la izquierda */
        background-color: var(--govco-white-color); /* Fondo blanco */
        border: 0px solid var(--govco-border-color); /* Borde alrededor */
        border-radius: 1px; /* Bordes redondeados */
        padding: 0.5rem 0; /* Espaciado interno */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra alrededor */
        z-index: 10; /* Capa superior */
    }

    /* Estilos para los enlaces de submenús */
    .submenu a {
        display: block; /* Muestra los enlaces en bloque */
        padding: 0.5rem 1rem; /* Espaciado interno */
        color: var(--govco-tertiary-color); /* Color del texto */
        text-decoration: none; /* Sin subrayado */
        font-size: 0.9rem; /* Tamaño de fuente */
    }

    /* Efecto hover en los enlaces de submenús */
    .submenu a:hover {
        background-color: var(--govco-gray-color); /* Fondo gris en hover */
        color: var(--govco-secondary-color); /* Cambia el color al hacer hover */
    }

    /* Mostrar el submenú al pasar el mouse sobre el elemento del menú principal */
    .menu-item:hover .submenu {
        display: block; /* Muestra el submenú */
    }

    /* Responsive: alineación vertical en pantallas pequeñas */
    @media (max-width: 768px) {
        .nav-links {
            flex-direction: column; /* Coloca los enlaces en columna */
            align-items: center; /* Centra los enlaces */
            gap: 1rem; /* Espacio de 1rem entre enlaces */
        }

        .submenu {
            position: static; /* Posiciona el submenú de forma estática */
            box-shadow: none; /* Sin sombra */
            border: none; /* Sin borde */
            background-color: transparent; /* Fondo transparente */
        }

        .submenu a {
            padding: 0.5rem 0; /* Ajusta el padding de los enlaces */
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