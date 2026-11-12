<?php
class Producto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerRecientes($limite = 10) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, precio, imagen FROM productos ORDER BY id DESC LIMIT :limite");
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>