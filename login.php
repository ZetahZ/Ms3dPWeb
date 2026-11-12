<?php
require_once 'config/conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Buscar el usuario en la base de datos por email
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        // Verificar el hash de la contraseña con password_verify
        if ($usuario && password_verify($password, $usuario['password'])) {
            
            // 1. Regenerar el ID de sesión por seguridad (mitigar Session Fixation)[cite: 5]
            session_regenerate_id(true);

            // 2. Almacenar los datos clave en la superglobal $_SESSION[cite: 5]
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['is_admin'] = $usuario['is_admin'];

            // 3. Redirigir al panel de administración o dashboard protegido[cite: 5]
            header('Location: index.php');
            exit;
        } else {
            $mensaje = "Credenciales incorrectas. Verifique su correo y contraseña.";
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

$titulo_pagina = "Iniciar Sesión";
require_once 'includes/header.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
                <span class="text-info small fw-bold">// M's3D - ACCESO AL SISTEMA</span>
                <h1 class="h2 fw-bold text-light mt-1 mb-4">Iniciar Sesión</h1>

                <?php if (!empty($_GET['registro']) && $_GET['registro'] === 'exitoso'): ?>
                    <div class="alert alert-success border-0 shadow-sm mb-4">¡Registro exitoso! Ya puede iniciar sesión.</div>
                <?php endif; ?>

                <?php if (!empty($_GET['error']) && $_GET['error'] === 'acceso_denegado'): ?>
                    <div class="alert alert-warning border-0 shadow-sm mb-4">Debe iniciar sesión para acceder a esta sección.</div>
                <?php endif; ?>

                <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-danger border-0 shadow-sm mb-4"><?= htmlspecialchars($mensaje); ?></div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Correo Electrónico</label>
                        <input type="email" class="form-control bg-black text-light border-secondary" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-muted">Contraseña</label>
                        <input type="password" class="form-control bg-black text-light border-secondary" id="password" name="password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-info fw-bold">Ingresar</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="text-muted small">¿No tienes cuenta? <a href="registro.php" class="text-info">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>