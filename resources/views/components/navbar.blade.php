<style>
    /* Estilos del navbar */
    .navbar {
        background-color: #333;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
    }

    .navbar .logo {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        margin-left: 1rem;
        font-size: 1rem;
    }

    .navbar a:hover {
        text-decoration: underline;
    }

    /* Enlaces de navegación */
    .nav-links {
        display: flex;
        align-items: center;
    }

    .nav-links a {
        margin-right: 1rem;
        transition: color 0.3s ease;
    }

    /* Botón */
    .navbar .login-btn {
        padding: 0.5rem 1rem;
        background-color: #3490dc;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        font-size: 1rem;
    }

    .navbar .login-btn:hover {
        background-color: #2779bd;
    }

    /* Responsive: para pantallas pequeñas */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .nav-links {
            flex-direction: column;
            width: 100%;
        }

        .nav-links a {
            margin: 0.5rem 0;
        }

        .navbar .login-btn {
            margin-top: 0.5rem;
        }
    }
</style>
<!-- Navbar -->
<nav class="navbar">
    <!-- Logo -->
    <div class="logo">
        MyApp
    </div>
    
    <!-- Navigation Links -->
    <div class="nav-links">
        <a href="#home">Home</a>
        <a href="#about">About Us</a>
        <a href="#services">Services</a>
        <a href="#contact">Contact</a>
    </div>

    <!-- Login Button -->
    <a href="{{ route('login') }}" class="login-btn">Log In</a>
</nav>

<main>
    <!-- Contenido principal -->
</main> 