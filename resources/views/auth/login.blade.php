@extends('layouts.guest')

@section('content')
<div class="login-card">
    <h2>Inicio de Sesión</h2>

    @if (session('status'))
        <div class="status-message">
            {{ session('status') }}
        </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Input -->
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required autofocus>
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="form-group remember-me">
            <input type="checkbox" id="remember_me" name="remember">
            <label for="remember_me">Recordarme</label>
        </div>

        <!-- Forgot Password Link and Submit Button -->
        <div class="form-group">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="button">Ingresar</button>
        </div>
    </form>
</div>
<style>
/* Estilos base y centrado de página */
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #e5e5e5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Tarjeta de inicio de sesión */
.login-card {
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 380px;
    text-align: center;
}

/* Título */
.login-card h2 {
    font-size: 1.8rem;
    color: #004170;
    margin-bottom: 1.5rem;
}

/* Grupo de formulario */
.form-group {
    margin-bottom: 1.5rem;
    text-align: left;
}

/* Etiquetas */
.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #333;
}

/* Campos de entrada */
.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 0.6rem;
    font-size: 1rem;
    border: 1px solid #ced4da;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

.form-group input[type="email"]:focus,
.form-group input[type="password"]:focus {
    border-color: #004170;
    outline: none;
}

/* Recordarme */
.remember-me {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
}

.remember-me input[type="checkbox"] {
    margin-right: 0.5rem;
}

/* Enlace de "Olvidaste tu contraseña" */
.forgot-password {
    font-size: 0.85rem;
    color: #0066cc;
    text-decoration: none;
}

.forgot-password:hover {
    text-decoration: underline;
}

/* Botón de envío */
.button {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    background-color: #004170;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #003055;
}

/* Mensaje de estado */
.status-message {
    font-size: 0.9rem;
    color: #38c172;
    margin-bottom: 1rem;
    text-align: center;
}
</style>
@endsection