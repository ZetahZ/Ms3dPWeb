<?php
require_once __DIR__ . '/../Models/Producto.php';

class ProductoController {
    private $modelo;

    public function __construct($pdo) {
        $this->modelo = new Producto($pdo);
    }

    public function listar() {
        // Obtenemos los productos desde el modelo
        $productos_iniciales = $this->modelo->obtenerRecientes(10);
        
        // Cargamos la vista pasándole los datos
        require_once __DIR__ . '/../Views/productos/index.php';
    }
}
?>