<?php
/**
 * Página Detalle de Anuncio - HabitaQ (DAW Práctica 7)
 * Requisitos (Página 3 del PDF):
 * - Muestra el detalle del anuncio seleccionado:
 *   Tipo de anuncio, tipo de vivienda, foto principal, título, precio, texto/descripción,
 *   fecha, ciudad, país, características (superficie, habitaciones, baños, planta, año de construcción),
 *   miniaturas de fotos y usuario propietario.
 * - Los datos se obtienen de datos_anuncios.php.
 * - La elección del anuncio depende de si el identificador recibido es PAR o IMPAR.
 */
require_once(__DIR__ . '/../php/funciones.php');
$anuncios = require(__DIR__ . '/../php/datos_anuncios.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$clave = ($id % 2 === 0) ? 'par' : 'impar';
$anuncio = $anuncios[$clave];

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$esRegistrado = ($usuarioActual !== '');
$title = 'Detalle: ' . $anuncio['titulo'];

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <article>
            <header>
                <p>Tipo de anuncio: <strong><?= e($anuncio['tipoAnuncio']); ?></strong></p>
                <p>Tipo de vivienda: <strong><?= e($anuncio['tipoVivienda']); ?></strong></p>
                <p>Identificador: <strong>#<?= $id; ?></strong> (<em><?= ($id % 2 === 0) ? 'Anuncio Par' : 'Anuncio Impar'; ?></em>)</p>
            </header>

            <img src="<?= e($anuncio['fotoPrincipal']); ?>" alt="<?= e($anuncio['titulo']); ?> - Imagen principal" width="400">
            <h2><?= e($anuncio['titulo']); ?></h2>
            <h3>Precio: <?= e($anuncio['precio']); ?></h3>

            <p><strong>Descripción:</strong> <?= e($anuncio['descripcion']); ?></p>
            <p><?= e($anuncio['fecha']); ?> &bull; <?= e($anuncio['ciudad']); ?>, <?= e($anuncio['pais']); ?></p>

            <!-- Características simplificadas según Nota 8 de la Práctica 7 -->
            <p><strong>Características del inmueble:</strong></p>
            <ul>
                <li>Superficie: <strong><?= e($anuncio['superficie']); ?></strong></li>
                <li>Número de habitaciones: <strong><?= e($anuncio['habitaciones']); ?></strong></li>
                <li>Número de baños: <strong><?= e($anuncio['banos']); ?></strong></li>
                <li>Planta: <strong><?= e($anuncio['planta']); ?></strong></li>
                <li>Año de construcción: <strong><?= e($anuncio['anyo']); ?></strong></li>
                <li>Ascensor: <strong><?= e($anuncio['ascensor']); ?></strong></li>
                <li>Zonas exteriores: <strong><?= e($anuncio['exterior']); ?></strong></li>
            </ul>

            <p><strong>Galería de fotografías:</strong></p>
            <p>
                <?php foreach ($anuncio['miniaturas'] as $idx => $min): ?>
                    <img src="<?= e($min); ?>" alt="Miniatura <?= $idx + 1; ?>" width="76" height="56" style="display: inline-block; margin-right: 0.5rem; object-fit: cover; border-radius: 4px;">
                <?php endforeach; ?>
            </p>

            <p>Propietario / Anunciante: <strong><?= e($anuncio['usuario']); ?></strong></p>

            <p style="margin-top: 1.5rem;">
                <a href="mensaje.php?id=<?= $id; ?><?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>" class="conBorde">
                    <i class="fa-solid fa-envelope" role="img" aria-label="Mensaje"></i> Contactar con el anunciante
                </a>
                <a href="resultadoBusqueda.php<?= $esRegistrado ? '?usuario=' . urlencode($usuarioActual) : ''; ?>" class="conBorde">
                    <i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Volver a los resultados
                </a>
            </p>
        </article>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
