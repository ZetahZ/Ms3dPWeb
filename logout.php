<?php
session_start();

// 1. Limpiar las variables de sesión
$_SESSION = [];

// 2. Eliminar la cookie de sesión del navegador si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destruir la sesión por completo
session_destroy();

// 4. Redirigir al login
header('Location: login.php?logout=success');
exit;
?>