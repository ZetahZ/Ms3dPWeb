<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Función auxiliar para activar la pestaña navegada según la página actual
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary px-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-info" href="index.php">
            <i class="bi bi-hexagon-fill me-2"></i>M's3D <span class="fs-6 text-muted">PRINT STUDIO</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto ms-4">
                <li class="nav-item">
                    <a class="nav-link <?= ($pagina_actual == 'index.php') ? 'active text-info fw-bold' : ''; ?>" href="index.php">CATÁLOGO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pagina_actual == 'modelos.php') ? 'active text-info fw-bold' : ''; ?>" href="modelos.php">MODELOS STL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pagina_actual == 'creador.php') ? 'active text-info fw-bold' : ''; ?>" href="creador.php">PANEL CREADOR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pagina_actual == 'nosotros.php') ? 'active text-info fw-bold' : ''; ?>" href="nosotros.php">NOSOTROS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pagina_actual == 'contacto.php') ? 'active text-info fw-bold' : ''; ?>" href="contacto.php">CONTACTO</a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center gap-2">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <!-- Si el usuario YA inició sesión: Muestra su nombre y Cerrar Sesión -->
                    <span class="text-light small me-2">Hola, <strong class="text-info"><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario') ?></strong></span>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm px-3">CERRAR SESIÓN</a>
                <?php else: ?>
                    <!-- Si el usuario NO ha iniciado sesión: Muestra el botón de Iniciar Sesión -->
                    <a href="login.php" class="btn btn-outline-light btn-sm px-3">INICIAR SESIÓN</a>
                <?php endif; ?>
                
                <!-- Botón de Carrito siempre visible -->
                <a href="carrito.php" class="btn btn-outline-info btn-sm px-3"><i class="bi bi-cart3 me-1"></i> Carrito</a>
            </div>
        </div>
    </div>
</nav>