<?php
/**
 * Página de Resultados de Búsqueda - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$esRegistrado = ($usuarioActual !== '');
$title = 'Resultados de Búsqueda';

// Recoger los filtros enviados por el formulario (GET)
$searchRapida = isset($_GET['search']) ? trim($_GET['search']) : '';
$tipoAnuncio  = isset($_GET['tipoAnuncio']) ? trim($_GET['tipoAnuncio']) : '';
$tipoVivienda = isset($_GET['tipoVivienda']) ? trim($_GET['tipoVivienda']) : '';
$ciudad       = isset($_GET['ciudad']) ? trim($_GET['ciudad']) : '';
$pais         = isset($_GET['pais']) ? trim($_GET['pais']) : '';
$precioMin    = isset($_GET['minPrice']) ? trim($_GET['minPrice']) : '';
$precioMax    = isset($_GET['maxPrice']) ? trim($_GET['maxPrice']) : '';
$fechaDesde   = isset($_GET['fechaDesde']) ? trim($_GET['fechaDesde']) : '';
$fechaHasta   = isset($_GET['fechaHasta']) ? trim($_GET['fechaHasta']) : '';

$hayFiltros = ($searchRapida !== '' || $tipoAnuncio !== '' || $ciudad !== '' || $precioMax !== '');

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section style="background-color: var(--color-superficie); border-left: 4px solid var(--color-primario);">
            <h2><i class="fa-solid fa-filter" role="img" aria-label="Filtros"></i> Criterios de búsqueda aplicados</h2>
            <p>Se muestran los resultados correspondientes a los siguientes criterios seleccionados:</p>

            <ul style="line-height: 1.8;">
                <?php if ($searchRapida !== ''): ?>
                    <li>Término de búsqueda rápida: <strong><?= e($searchRapida); ?></strong></li>
                <?php endif; ?>
                <li>Tipo de anuncio: <strong><?= e($tipoAnuncio ?: 'Cualquiera / No especificado'); ?></strong></li>
                <li>Tipo de vivienda: <strong><?= e($tipoVivienda ?: 'Cualquiera / No especificado'); ?></strong></li>
                <li>Ciudad: <strong><?= e($ciudad ?: ($searchRapida ?: 'Todas las ciudades')); ?></strong></li>
                <li>País: <strong><?= e($pais ?: 'España'); ?></strong></li>
                <li>Rango de precio: <strong><?= e($precioMin ?: '0'); ?> €</strong> hasta <strong><?= e($precioMax ? $precioMax . ' €' : 'Sin límite'); ?></strong></li>
                <?php if ($fechaDesde !== '' || $fechaHasta !== ''): ?>
                    <li>Rango de fechas: <strong><?= e($fechaDesde ?: 'Inicio'); ?></strong> hasta <strong><?= e($fechaHasta ?: 'Hoy'); ?></strong></li>
                <?php endif; ?>
            </ul>
        </section>

        <section>
            <h2>Inmuebles encontrados</h2>
            <p>Se han encontrado <strong>5</strong> inmuebles disponibles según los criterios consultados:</p>

            <a href="detalleAdd.php?id=1<?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>">
                <article class="anuncio">
                    <img src="../img/casa1.png" alt="Casa moderna con jardín" width="200">
                    <h3>Casa moderna con jardín</h3>
                    <p>Valencia, España &bull; 15/09/2026</p>
                    <p><strong>285.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=2<?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>">
                <article class="anuncio">
                    <img src="../img/casa2.png" alt="Chalet junto al mar" width="200">
                    <h3>Chalet junto al mar</h3>
                    <p>Alicante, España &bull; 18/09/2026</p>
                    <p><strong>420.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=3<?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>">
                <article class="anuncio">
                    <img src="../img/casa3.png" alt="Casa rural de montaña" width="200">
                    <h3>Casa rural de montaña</h3>
                    <p>Granada, España &bull; 20/09/2026</p>
                    <p><strong>195.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=4<?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>">
                <article class="anuncio">
                    <img src="../img/casa4.png" alt="Ático céntrico con terraza" width="200">
                    <h3>Ático céntrico con terraza</h3>
                    <p>Madrid, España &bull; 22/09/2026</p>
                    <p><strong>310.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=5<?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>">
                <article class="anuncio">
                    <img src="../img/casa5.png" alt="Dúplex de diseño" width="200">
                    <h3>Dúplex de diseño</h3>
                    <p>Barcelona, España &bull; 25/09/2026</p>
                    <p><strong>380.000 €</strong></p>
                </article>
            </a>

            <div style="margin-top: 1.5rem;">
                <p>
                    <a href="formBusqueda.php<?= $esRegistrado ? '?usuario=' . urlencode($usuarioActual) : ''; ?>" class="conBorde">
                        <i class="fa-solid fa-sliders" role="img" aria-label="Modificar"></i> Modificar criterios de búsqueda
                    </a>
                </p>
            </div>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
