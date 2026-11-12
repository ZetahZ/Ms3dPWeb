<?php
require_once '../config/conexion.php';

$stmt = $pdo->query("SELECT * FROM productos ORDER BY id DESC");
$registros = $stmt->fetchAll();

$titulo_pagina = "Gestión de Productos 3D";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container my-5">
    <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="text-info small fw-bold">// MÓDULO CRUD - HITO 2</span>
                <h1 class="h2 fw-bold text-light mt-1">Gestión de Productos 3D</h1>
            </div>
            <a href="crear.php" class="btn btn-info fw-bold">Agregar Nuevo Producto</a>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered border-secondary align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($registros)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No hay productos cargados en la base de datos todavía.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($registros as $item): ?>
                            <?php 
                                // Procesar la URL de la imagen desde Supabase Storage
                                $imagen_db = $item['imagen'] ?? '';
                                if (!empty($imagen_db)) {
                                    $url_imagen = (strpos($imagen_db, 'http') === 0) 
                                        ? $imagen_db 
                                        : "https://kumddrxatpazhdqtqjwt.supabase.co/storage/v1/object/public/productos/" . $imagen_db; 
                                } else {
                                    $url_imagen = "https://via.placeholder.com/60?text=Sin+Foto";
                                }
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($item['id'] ?? '') ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($url_imagen) ?>" alt="Producto" class="rounded border border-secondary" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="fw-bold text-light"><?= htmlspecialchars($item['nombre'] ?? 'Sin nombre') ?></td>
                                <td class="text-info">$<?= number_format($item['precio'] ?? 0, 2) ?></td>
                                <td><?= htmlspecialchars($item['stock'] ?? 0) ?> un.</td>
                                <td>
                                    <?php if (!empty($item['activo'])): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="editar.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-warning me-2">Editar</a>
                                    <a href="eliminar.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Confirma eliminar este registro?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>