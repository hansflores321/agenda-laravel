<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión - Sistema de Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Iniciar Sesión</h3>
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
    <label class="form-label">Usuario</label>
    <input type="text" name="username" class="form-control" required>
</div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                <div class="text-center mt-3">
    <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate aquí</a>
</div>
            </form>
        </div>
    </div>
</div>
</body>
</html>