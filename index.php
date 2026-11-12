<?php
require_once 'config/conexion.php';
require_once 'app/Controllers/ProductoController.php';

// Instanciamos el controlador pasándole la conexión PDO y ejecutamos la acción listar
$controlador = new ProductoController($pdo);
$controlador->listar();