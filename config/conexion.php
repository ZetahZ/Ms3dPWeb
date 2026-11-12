<?php
$host = 'aws-0-us-east-1.pooler.supabase.com';
$port = '5432';
$db   = 'postgres';
$user = 'postgres.kumddrxatpazhdqtqjwt';
$pass = 'YNDel5A6JQcouOga'; // Pon tu contraseña exacta entre las comillas

$dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "¡Conexión exitosa a Supabase!";
} catch (PDOException $e) {
    echo "<h3>Error detectado:</h3>";
    echo "Mensaje: " . $e->getMessage() . "<br>";
    echo "Usuario intentado: <code>" . $user . "</code><br>";
    echo "Host intentado: <code>" . $host . "</code>";
}
?>