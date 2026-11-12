<?php
$titulo_pagina = "Contacto";
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="p-5 rounded-3 bg-gradient border border-secondary shadow-lg" style="background-color: #121824;">
                <span class="text-info small fw-bold">// COMUNICATE CON EL TALLER</span>
                <h1 class="h2 fw-bold text-light mt-2 mb-4">Contacto</h1>
                
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label text-muted">Tu Nombre</label>
                        <input type="text" class="form-control bg-black text-light border-secondary" id="nombre" placeholder="Ej. Juan Pérez" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Correo Electrónico</label>
                        <input type="email" class="form-control bg-black text-light border-secondary" id="email" placeholder="nombre@ejemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label text-muted">Mensaje o Consulta sobre Impresión 3D</label>
                        <textarea class="form-control bg-black text-light border-secondary" id="mensaje" rows="4" placeholder="Cuéntanos sobre tu idea, archivo STL o presupuesto..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-info fw-bold px-4">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>