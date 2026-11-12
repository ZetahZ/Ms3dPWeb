<?php
require_once 'config/conexion.php';

// Consulta inicial por defecto para mostrar hasta 10 productos al cargar la página
$stmt = $pdo->query("SELECT id, nombre, precio, imagen FROM productos LIMIT 10");
$productos_iniciales = $stmt->fetchAll(PDO::FETCH_ASSOC);

$titulo_pagina = "Catálogo Principal";
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container my-4">
    <!-- Hero Section -->
    <section class="p-5 mb-4 rounded-3 bg-gradient border border-secondary" style="background-color: #121824;">
        <span class="text-info small fw-bold">// IMPRESIÓN 3D ARGENTINA</span>
        <h1 class="display-5 fw-bold text-light mt-2">Todo lo que imprimimos</h1>
        <p class="col-md-8 fs-5 text-muted">
            Desde juguetes articulados hasta repuestos técnicos. Cada pieza sale directo del taller a tu puerta.
        </p>
    </section>

    <!-- Categorías -->
    <section class="mb-5">
        <span class="text-muted small fw-bold">// NAVEGAR POR CATEGORÍA</span>
        <div class="row g-3 mt-1">
            <div class="col-md-2"><div class="p-3 border border-secondary rounded text-center bg-black"><i class="bi bi-controller fs-3 text-info"></i><div class="small mt-2">Juguetes y Juegos</div></div></div>
            <div class="col-md-2"><div class="p-3 border border-secondary rounded text-center bg-black"><i class="bi bi-key fs-3 text-warning"></i><div class="small mt-2">Llaveros Personalizados</div></div></div>
            <div class="col-md-2"><div class="p-3 border border-secondary rounded text-center bg-black"><i class="bi bi-flower2 fs-3 text-success"></i><div class="small mt-2">Macetas y Decoración</div></div></div>
            <div class="col-md-2"><div class="p-3 border border-secondary rounded text-center bg-black"><i class="bi bi-shield-shaded fs-3 text-danger"></i><div class="small mt-2">Figuras y Coleccionables</div></div></div>
            <div class="col-md-2"><div class="p-3 border border-secondary rounded text-center bg-black"><i class="bi bi-arrow-repeat fs-3 text-primary"></i><div class="small mt-2">Anti-estrés y Fidgets</div></div></div>
            <div class="col-md-2"><div class="p-3 border border-secondary rounded text-center bg-black"><i class="bi bi-gear fs-3 text-secondary"></i><div class="small mt-2">Repuestos y Piezas Técnicas</div></div></div>
        </div>
    </section>

    <!-- Barra de Búsqueda Asincrónica (TP9) -->
    <section class="mb-4">
        <span class="text-muted small fw-bold">// BÚSQUEDA EN TIEMPO REAL</span>
        <div class="input-group mt-2">
            <span class="input-group-text bg-dark border-secondary text-info">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" id="inputBusqueda" class="form-control bg-black text-light border-secondary" placeholder="Buscar productos por nombre..." autocomplete="off">
        </div>
    </section>

    <!-- Catálogo de productos (Dinámico con AJAX / Fetch API) -->
    <section>
        <span class="text-muted small fw-bold">// CATÁLOGO COMPLETO</span>
        <h2 class="h3 text-light mt-1 mb-3">Todos los productos</h2>
        
        <!-- Contenedor donde se inyectan los resultados en tiempo real -->
        <div id="resultados">
            <?php if (empty($productos_iniciales)): ?>
                <div class="alert alert-secondary text-center py-4 bg-black border-secondary text-muted" role="alert">
                    No hay productos cargados en la base de datos todavía. ¡Agrega algunos desde el panel de administración!
                </div>
            <?php else: ?>
                <div class="row g-3">
                    <?php foreach ($productos_iniciales as $producto): ?>
                        <div class="col-md-4">
                            <div class="card bg-dark text-light border-secondary shadow-sm p-3 h-100">
                                <?php 
                                    $imagen_db = $producto['imagen'] ?? '';
                                    if (!empty($imagen_db)) {
                                        $url_imagen = (strpos($imagen_db, 'http') === 0) 
                                            ? $imagen_db 
                                            : "https://kumddrxatpazhdqtqjwt.supabase.co/storage/v1/object/public/productos/" . $imagen_db; 
                                    } else {
                                        $url_imagen = "https://via.placeholder.com/300x200?text=Sin+Foto";
                                    }
                                ?>
                                <img src="<?= htmlspecialchars($url_imagen) ?>" class="card-img-top mb-2 rounded" alt="Producto" style="height: 180px; object-fit: cover;">
                                <h5 class="text-info"><?= htmlspecialchars($producto['nombre']) ?></h5>
                                <p class="text-muted mb-0">Precio: <span class="text-light fw-bold">$<?= htmlspecialchars($producto['precio']) ?></span></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Inclusión del script JavaScript de la API Fetch para el TP9 -->
<script src="js/app.js"></script>

<?php require_once 'includes/footer.php'; ?>