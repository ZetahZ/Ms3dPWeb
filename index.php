<?php
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

    <!-- Catálogo de productos -->
    <section>
        <span class="text-muted small fw-bold">// CATÁLOGO COMPLETO</span>
        <h2 class="h3 text-light mt-1 mb-3">Todos los productos</h2>
        
        <div class="alert alert-secondary text-center py-4 bg-black border-secondary text-muted" role="alert">
            No hay productos cargados en la base de datos todavía. ¡Agrega algunos desde la API o Swagger!
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>