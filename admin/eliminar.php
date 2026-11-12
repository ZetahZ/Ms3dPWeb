<?php
require_once '../config/conexion.php';

// 1. Obtener el ID desde la URL
$id = $_GET['id'] ?? null;

if (!empty($id)) {
    // 2. Consulta Preparada para eliminar el registro de forma segura
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

// 3. Redirigir de regreso al panel principal
header('Location: index.php?status=deleted');
exit;
?>