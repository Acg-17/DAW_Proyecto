<?php
/**
 * Página "Ver anuncio" (Área privada) - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');
$anuncios = require(__DIR__ . '/../php/datos_anuncios.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$clave = ($id % 2 === 0) ? 'par' : 'impar';
$anuncio = $anuncios[$clave];

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : 'Pau';
$title = 'Ver Anuncio - ' . $anuncio['titulo'];
$esRegistrado = true;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <header>
            <div>
                <h2><i class="fa-solid fa-house-chimney" role="img" aria-label="Anuncio"></i> Ficha del Inmueble (Panel Privado)</h2>
                <p>Identificador de anuncio: <strong>#<?= $id; ?></strong></p>
            </div>
            <div>
                <a href="anadirFoto.php?id=<?= $id; ?>&usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-camera" role="img" aria-label="Añadir foto"></i> Añadir foto a este anuncio</a>
            </div>
        </header>

        <article>
            <header>
                <p>Tipo de anuncio: <strong><?= e($anuncio['tipoAnuncio']); ?></strong></p>
                <p>Tipo de vivienda: <strong><?= e($anuncio['tipoVivienda']); ?></strong></p>
                <p>Propietario: <strong><?= e($anuncio['usuario']); ?></strong></p>
            </header>

            <img src="<?= e($anuncio['fotoPrincipal']); ?>" alt="<?= e($anuncio['titulo']); ?>" width="500">
            <h2><?= e($anuncio['titulo']); ?></h2>
            <h3>Precio: <?= e($anuncio['precio']); ?></h3>

            <p><strong>Descripción:</strong> <?= e($anuncio['descripcion']); ?></p>
            <p><?= e($anuncio['fecha']); ?> &bull; <?= e($anuncio['ciudad']); ?>, <?= e($anuncio['pais']); ?></p>

            <p><strong>Características principales del inmueble:</strong></p>
            <ul>
                <li>Superficie: <strong><?= e($anuncio['superficie']); ?></strong></li>
                <li>Habitaciones: <strong><?= e($anuncio['habitaciones']); ?></strong></li>
                <li>Baños: <strong><?= e($anuncio['banos']); ?></strong></li>
                <li>Planta: <strong><?= e($anuncio['planta']); ?></strong></li>
                <li>Año de construcción: <strong><?= e($anuncio['anyo']); ?></strong></li>
                <li>Ascensor: <strong><?= e($anuncio['ascensor']); ?></strong></li>
                <li>Zonas exteriores: <strong><?= e($anuncio['exterior']); ?></strong></li>
            </ul>

            <p><strong>Galería de fotografías asociadas:</strong></p>
            <p>
                <?php foreach ($anuncio['miniaturas'] as $idx => $miniatura): ?>
                    <img src="<?= e($miniatura); ?>" alt="Miniatura <?= $idx + 1; ?> de <?= e($anuncio['titulo']); ?>" width="76" height="56" style="display: inline-block; margin-right: 0.5rem; object-fit: cover; border-radius: 4px;">
                <?php endforeach; ?>
            </p>

            <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="anadirFoto.php?id=<?= $id; ?>&usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-camera" role="img" aria-label="Añadir foto"></i> Añadir foto a este anuncio</a>
                <a href="misAnuncios.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-list-check" role="img" aria-label="Mis Anuncios"></i> Volver a mis anuncios</a>
                <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-user" role="img" aria-label="Perfil"></i> Panel de usuario</a>
            </div>
        </article>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
