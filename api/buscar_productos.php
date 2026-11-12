<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config/conexion.php'; // Ajusta la ruta a tu conexión PDO

$busqueda = isset($_GET['q']) ? trim($_GET['q']) : '';

try {
    if (!empty($busqueda)) {
        $stmt = $pdo->prepare("SELECT id, nombre, precio, imagen FROM productos WHERE nombre ILIKE :query");
        $stmt->execute([':query' => "%{$busqueda}%"]);
    } else {
        $stmt = $pdo->query("SELECT id, nombre, precio, imagen FROM productos LIMIT 10");
    }
    
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => $productos
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al consultar la base de datos'
    ]);
}
?>