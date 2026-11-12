<?php
require_once '../config/conexion.php';

$mensaje_error = "";
$producto = null;

// 1. Obtener el ID del producto a editar desde la URL
$id = $_GET['id'] ?? null;

if (empty($id)) {
    header('Location: index.php');
    exit;
}

// 2. Si se envió el formulario (Método POST), actualizamos los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = $_POST['precio'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $activo = isset($_POST['activo']) ? 1 : 0;
    $categoria_id = !empty($_POST['categoria_id']) ? $_POST['categoria_id'] : null;

    if (!empty($nombre) && !empty($precio)) {
        // Consulta Preparada para actualizar (Anti SQL Injection)
        $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, stock = :stock, activo = :activo, categoria_id = :categoria_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre'       => $nombre,
            ':precio'       => $precio,
            ':stock'        => $stock,
            ':activo'       => $activo,
            ':categoria_id' => $categoria_id,
            ':id'           => $id
        ]);

        header('Location: index.php?status=updated');
        exit;
    } else {
        $mensaje_error = "El nombre y el precio son obligatorios.";
    }
}

// 3. Buscar los datos actuales del producto para rellenar el formulario
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute([':id' => $id]);
$producto = $stmt->fetch();

if (!$producto) {
    header('Location: index.php');
    exit;
}

$titulo_pagina = "Editar Producto 3D";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
                <span class="text-warning small fw-bold">// MÓDULO CRUD - EDITAR PRODUCTO</span>
                <h1 class="h2 fw-bold text-light mt-1 mb-4">Editar Producto ID: <?= htmlspecialchars($producto['id']) ?></h1>

                <?php if (!empty($mensaje_error)): ?>
                    <div class="alert alert-danger border-0 shadow-sm" role="alert">
                        <?= htmlspecialchars($mensaje_error); ?>
                    </div>
                <?php endif; ?>

                <form action="editar.php?id=<?= $producto['id'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label text-muted">Nombre del Producto</label>
                        <input type="text" class="form-control bg-black text-light border-secondary" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label text-muted">Precio ($)</label>
                            <input type="number" step="0.01" class="form-control bg-black text-light border-secondary" id="precio" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label text-muted">Stock Disponible</label>
                            <input type="number" class="form-control bg-black text-light border-secondary" id="stock" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" min="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoria_id" class="form-label text-muted">ID de Categoría</label>
                            <input type="number" class="form-control bg-black text-light border-secondary" id="categoria_id" name="categoria_id" value="<?= htmlspecialchars($producto['categoria_id'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3 d-flex align-items-center">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" <?= !empty($producto['activo']) ? 'checked' : '' ?>>
                                <label class="form-check-label text-light" for="activo">Producto Activo / Visible</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning fw-bold px-4">Actualizar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>