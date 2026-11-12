<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php?error=acceso_denegado');
    exit;
}

// Función auxiliar para verificar si es administrador usando tu campo 'is_admin'
function verificar_admin() {
    if (empty($_SESSION['is_admin'])) {
        header('Location: ../index.php?error=no_autorizado');
        exit;
    }
}
?>