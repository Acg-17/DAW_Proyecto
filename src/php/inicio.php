<?php
/**
 * Inicio del cuerpo y barra de navegación - HabitaQ (DAW Práctica 7)
 * Cumple con la Sección 4.4 (Páginas 8-9): Estructura modular independiente
 */
$esRegistrado = !empty($esRegistrado);
$urlInicio = $esRegistrado ? 'indexRegistrado.php' : 'index.php';
$usuarioUrlParam = !empty($usuarioActual) ? '?usuario=' . urlencode($usuarioActual) : '';
?>
<body>
    <!-- Enlace accesible de salto al contenido principal (Requisito Práctica 4) -->
    <a href="#contenido-principal" class="saltar-a">Saltar al contenido principal</a>

    <header>
        <a href="<?= $urlInicio . $usuarioUrlParam; ?>">
            <img src="../img/favicon.png" alt="HabitaQ" width="100">
            <h1>HabitaQ</h1>
        </a>
        <nav>
            <ul>
                <?php if ($esRegistrado): ?>
                    <li><a href="indexRegistrado.php<?= $usuarioUrlParam; ?>"><i class="fa-solid fa-house" role="img" aria-label="Inicio"></i> Inicio</a></li>
                    <li><a href="formBusqueda.php<?= $usuarioUrlParam; ?>"><i class="fa-solid fa-magnifying-glass" role="img" aria-label="Búsqueda Avanzada"></i> Búsqueda Avanzada</a></li>
                    <li><a href="crearAnuncio.php<?= $usuarioUrlParam; ?>"><i class="fa-solid fa-circle-plus" role="img" aria-label="Publicar anuncio"></i> Publicar anuncio</a></li>
                    <li><a href="menuUsuario.php<?= $usuarioUrlParam; ?>"><i class="fa-solid fa-user" role="img" aria-label="Mi perfil"></i> Mi perfil</a></li>
                    <li><a href="index.php"><i class="fa-solid fa-right-from-bracket" role="img" aria-label="Cerrar sesión"></i> Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="index.php"><i class="fa-solid fa-house" role="img" aria-label="Inicio"></i> Inicio</a></li>
                    <li><a href="formBusqueda.php"><i class="fa-solid fa-magnifying-glass" role="img" aria-label="Búsqueda Avanzada"></i> Búsqueda Avanzada</a></li>
                    <li><a href="registro.php"><i class="fa-solid fa-user-plus" role="img" aria-label="Registro"></i> Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
