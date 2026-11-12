<?php
$titulo_pagina = "Nosotros";
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container my-5">
    <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
        <span class="text-info small fw-bold">// SOBRE EL ESTUDIO</span>
        <h1 class="display-6 fw-bold text-light mt-2 mb-3">M's3D Print Studio</h1>
        <p class="fs-5 text-muted leading-relaxed">
            Somos un taller especializado en impresión 3D en Argentina, enfocados en transformar ideas digitales en piezas físicas de alta precisión. Desde juguetes articulados y coleccionables hasta repuestos técnicos y decoración personalizada, cada objeto sale directo de nuestras impresoras a tu puerta.
        </p>
        <hr class="border-secondary my-4">
        <div class="row g-4">
            <div class="col-md-4">
                <h3 class="h5 text-info"><i class="bi bi-cpu me-2"></i>Tecnología</h3>
                <p class="text-muted small">Equipamiento de última generación para asegurar acabados detallados y gran resistencia estructural.</p>
            </div>
            <div class="col-md-4">
                <h3 class="h5 text-info"><i class="bi bi-shield-check me-2"></i>Calidad</h3>
                <p class="text-muted small">Uso de materiales de primera calidad (PLA, PETG) optimizados para cada tipo de uso.</p>
            </div>
            <div class="col-md-4">
                <h3 class="h5 text-info"><i class="bi bi-truck me-2"></i>Envíos</h3>
                <p class="text-muted small">Despachos seguros y protegidos para que tus piezas lleguen en perfectas condiciones.</p>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>