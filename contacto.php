<?php
$titulo_pagina = "Contacto";
require_once 'includes/header.php';
require_once 'includes/nav.php';

// Variables para manejar mensajes y persistencia
$mensaje_estado = "";
$tipo_alerta = "";
$nombre_val = "";
$email_val = "";
$mensaje_val = "";

// Verificar si se envió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitización estricta (Prevención XSS y espacios vacíos)
    $nombre_val = trim($_POST['nombre'] ?? '');
    $email_val = trim($_POST['email'] ?? '');
    $mensaje_val = trim($_POST['mensaje'] ?? '');

    $nombre_limpio = htmlspecialchars($nombre_val, ENT_QUOTES, 'UTF-8');
    $email_limpio = htmlspecialchars($email_val, ENT_QUOTES, 'UTF-8');
    $mensaje_limpio = htmlspecialchars($mensaje_val, ENT_QUOTES, 'UTF-8');

    // 2. Validación en el Servidor
    if (empty($nombre_limpio) || empty($email_limpio) || empty($mensaje_limpio)) {
        $mensaje_estado = "Por favor, completa todos los campos obligatorios.";
        $tipo_alerta = "danger";
    } elseif (!filter_var($email_limpio, FILTER_VALIDATE_EMAIL)) {
        $mensaje_estado = "El formato del correo electrónico no es válido.";
        $tipo_alerta = "danger";
    } else {
        // Si todo es correcto, simulamos el éxito del envío
        $mensaje_estado = "¡Mensaje enviado con éxito! Gracias por contactarte con M's3D Print Studio, " . $nombre_limpio . ".";
        $tipo_alerta = "success";
        
        // Limpiamos los valores para que el formulario quede en blanco si se envió bien
        $nombre_val = "";
        $email_val = "";
        $mensaje_val = "";
    }
}
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
                <span class="text-info small fw-bold">// COMUNICATE CON EL TALLER (POST)</span>
                <h1 class="h2 fw-bold text-light mt-2 mb-4">Contacto</h1>
                
                <!-- Alertas de retroalimentación -->
                <?php if (!empty($mensaje_estado)): ?>
                    <div class="alert alert-<?= $tipo_alerta; ?> border-0 shadow-sm" role="alert">
                        <?= $mensaje_estado; ?>
                    </div>
                <?php endif; ?>

                <form action="contacto.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label text-muted">Tu Nombre</label>
                        <input type="text" class="form-control bg-black text-light border-secondary" id="nombre" name="nombre" value="<?= $nombre_val; ?>" placeholder="Ej. Juan Pérez" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Correo Electrónico</label>
                        <input type="email" class="form-control bg-black text-light border-secondary" id="email" name="email" value="<?= $email_val; ?>" placeholder="nombre@ejemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label text-muted">Mensaje o Consulta sobre Impresión 3D</label>
                        <textarea class="form-control bg-black text-light border-secondary" id="mensaje" name="mensaje" rows="4" placeholder="Cuéntanos sobre tu idea, archivo STL o presupuesto..." required><?= $mensaje_val; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-info fw-bold px-4">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>