<?php
require_once 'config/conexion.php';

$mensaje = "";
$tipo_alerta = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($nombre) && !empty($email) && !empty($password)) {
        // 1. Verificar si el correo ya existe en la base de datos
        $stmt_check = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt_check->execute([':email' => $email]);

        if ($stmt_check->rowCount() > 0) {
            $mensaje = "El correo electrónico ya se encuentra registrado.";
            $tipo_alerta = "danger";
        } else {
            // 2. Hash seguro de la contraseña según OWASP
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            
            // 3. Insertar el nuevo usuario usando bindValue para tipos booleanos en PostgreSQL
            $sql = "INSERT INTO usuarios (nombre, email, password, is_admin, is_active) 
                    VALUES (:nombre, :email, :password, :is_admin, :is_active)";
            
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':is_admin', false, PDO::PARAM_BOOL);
            $stmt->bindValue(':is_active', true, PDO::PARAM_BOOL);
            
            if ($stmt->execute()) {
                header('Location: login.php?registro=exitoso');
                exit;
            } else {
                $mensaje = "Error al registrar el usuario en la base de datos.";
                $tipo_alerta = "danger";
            }
        }
    } else {
        $mensaje = "Todos los campos son obligatorios.";
        $tipo_alerta = "warning";
    }
}

$titulo_pagina = "Registro de Usuario";
require_once 'includes/header.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
                <span class="text-info small fw-bold">// M's3D - REGISTRO DE CUENTA</span>
                <h1 class="h2 fw-bold text-light mt-1 mb-4">Crear Cuenta</h1>

                <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-<?= $tipo_alerta ?> border-0 shadow-sm" role="alert">
                        <?= htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>

                <form action="registro.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label text-muted">Nombre Completo</label>
                        <input type="text" class="form-control bg-black text-light border-secondary" id="nombre" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Correo Electrónico</label>
                        <input type="email" class="form-control bg-black text-light border-secondary" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-muted">Contraseña</label>
                        <input type="password" class="form-control bg-black text-light border-secondary" id="password" name="password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-info fw-bold">Registrarse</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="text-muted small">¿Ya tienes una cuenta? <a href="login.php" class="text-info">Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>