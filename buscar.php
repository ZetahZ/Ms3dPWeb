<?php
$titulo_pagina = "Buscar Modelos";
require_once 'includes/header.php';
require_once 'includes/nav.php';

$busqueda_val = "";
if (isset($_GET['q'])) {
    $busqueda_val = trim($_GET['q']);
    $busqueda_limpia = htmlspecialchars($busqueda_val, ENT_QUOTES, 'UTF-8');
} else {
    $busqueda_limpia = "";
}
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
                <span class="text-info small fw-bold">// MÓDULO DE CONSULTAS (GET)</span>
                <h1 class="h2 fw-bold text-light mt-2 mb-4">Buscar en el Catálogo</h1>
                
                <!-- Formulario GET -->
                <form action="buscar.php" method="GET" class="row g-3 mb-4">
                    <div class="col-md-9">
                        <input type="text" class="form-control bg-black text-light border-secondary" name="q" value="<?= $busqueda_limpia; ?>" placeholder="Ej. Llaveros, Juguetes articulados..." required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info w-100 fw-bold">Buscar</button>
                    </div>
                </form>

                <?php if (!empty($busqueda_limpia)): ?>
                    <div class="alert alert-secondary bg-black border-secondary text-light" role="alert">
                        Resultados de la búsqueda para: <strong class="text-info"><?= $busqueda_limpia; ?></strong>
                    </div>
                    <p class="text-muted">Aquí se mostrarían los productos filtrados desde la base de datos que coincidan con tu término de búsqueda.</p>
                <?php else: ?>
                    <p class="text-muted">Ingresa un término arriba para comenzar la búsqueda rápida mediante el método GET.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>