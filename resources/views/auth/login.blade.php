<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Estilo para centrar el formulario */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .login-card {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #555;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }

        .form-group a {
            font-size: 0.85rem;
            color: #3490dc;
            text-decoration: none;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        .form-group .button {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            background-color: #3490dc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group .button:hover {
            background-color: #2779bd;
        }

        .status-message {
            font-size: 0.9rem;
            color: #38c172;
            margin-bottom: 1rem;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="login-card">
        <h2>Login</h2>

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
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-group">
                <label for="remember_me">
                    <input type="checkbox" id="remember_me" name="remember">
                    Remember me
                </label>
            </div>

            <!-- Forgot Password Link and Submit Button -->
            <div class="form-group">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="button">Log in</button>
            </div>
        </form>
    </div>
</body>
</html>
