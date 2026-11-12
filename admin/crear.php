<?php
require_once '../config/conexion.php';

$mensaje_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = $_POST['precio'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $activo = isset($_POST['activo']) ? 1 : 0;
    $categoria_id = !empty($_POST['categoria_id']) ? $_POST['categoria_id'] : null;
    $imagen_nombre = '';

    // Manejo de la subida de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagen']['tmp_name'];
        $fileName = $_FILES['imagen']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Extensiones permitidas
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        
        if (in_array($fileExtension, $allowedExtensions)) {
            // Generar un nombre único para evitar colisiones
            $nuevoNombreImagen = md5(time() . $fileName) . '.' . $fileExtension;
            
            // Carpeta local de subidas temporal o definitiva en tu proyecto (ej: ../uploads/)
            // Asegúrate de que la carpeta 'uploads' exista en la raíz de tu proyecto
            $uploadFileDir = '../uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            
            $dest_path = $uploadFileDir . $nuevoNombreImagen;
            
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagen_nombre = $nuevoNombreImagen;
            } else {
                $mensaje_error = "Error al mover el archivo subido al servidor local.";
            }
        } else {
            $mensaje_error = "Formato de imagen no permitido. Usa JPG, JPEG, PNG o WEBP.";
        }
    }

    if (empty($mensaje_error) && !empty($nombre) && !empty($precio)) {
        // Consulta Preparada (Anti SQL Injection) adaptada a tus columnas reales
        $sql = "INSERT INTO productos (nombre, precio, stock, activo, categoria_id, imagen) 
                VALUES (:nombre, :precio, :stock, :activo, :categoria_id, :imagen)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre'       => $nombre,
            ':precio'       => $precio,
            ':stock'        => $stock,
            ':activo'       => $activo,
            ':categoria_id' => $categoria_id,
            ':imagen'       => $imagen_nombre
        ]);

        header('Location: index.php?status=created');
        exit;
    } elseif(empty($mensaje_error)) {
        $mensaje_error = "El nombre y el precio son obligatorios.";
    }
}

$titulo_pagina = "Agregar Producto 3D";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
                <span class="text-info small fw-bold">// MÓDULO CRUD - CREAR PRODUCTO</span>
                <h1 class="h2 fw-bold text-light mt-1 mb-4">Agregar Nuevo Producto</h1>

                <?php if (!empty($mensaje_error)): ?>
                    <div class="alert alert-danger border-0 shadow-sm" role="alert">
                        <?= htmlspecialchars($mensaje_error); ?>
                    </div>
                <?php endif; ?>

                <form action="crear.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label text-muted">Nombre del Producto</label>
                        <input type="text" class="form-control bg-black text-light border-secondary" id="nombre" name="nombre" placeholder="Ej. Llavero Iron Man Articulado" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label text-muted">Precio ($)</label>
                            <input type="number" step="0.01" class="form-control bg-black text-light border-secondary" id="precio" name="precio" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label text-muted">Stock Disponible</label>
                            <input type="number" class="form-control bg-black text-light border-secondary" id="stock" name="stock" value="10" min="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoria_id" class="form-label text-muted">ID de Categoría</label>
                            <input type="number" class="form-control bg-black text-light border-secondary" id="categoria_id" name="categoria_id" placeholder="Ej. 1">
                        </div>
                        <div class="col-md-6 mb-3 d-flex align-items-center">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" checked>
                                <label class="form-check-label text-light" for="activo">Producto Activo / Visible</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="imagen" class="form-label text-muted">Imagen del Producto</label>
                        <input type="file" class="form-control bg-black text-light border-secondary" id="imagen" name="imagen" accept="image/*">
                        <div class="form-text text-muted">Sube una imagen representativa de la impresión 3D.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-info fw-bold px-4">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>