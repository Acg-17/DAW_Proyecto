<?php
/**
 * Página de Resultados de Búsqueda - HabitaQ (DAW Práctica 7)
 * Requisitos (Página 3 del PDF):
 * - Además del ejemplo de resultado que ya contiene (datos estáticos),
 *   muestra los datos reales que el usuario ha introducido en el formulario de búsqueda.
 * - Recibe peticiones tanto de la "búsqueda rápida" (campo search) como del formulario avanzado.
 */
require_once(__DIR__ . '/../php/funciones.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$esRegistrado = ($usuarioActual !== '');
$title = 'Resultados de la Búsqueda';

// Recoger datos reales introducidos por el usuario
$searchRapida = isset($_GET['search']) ? trim($_GET['search']) : '';
$tipoAnuncio  = isset($_GET['tipoAnuncio']) ? trim($_GET['tipoAnuncio']) : '';
$tipoVivienda = isset($_GET['tipoVivienda']) ? trim($_GET['tipoVivienda']) : '';
$ciudad       = isset($_GET['ciudad']) ? trim($_GET['ciudad']) : '';
$pais         = isset($_GET['pais']) ? trim($_GET['pais']) : '';
$precioMin    = isset($_GET['precioMin']) ? trim($_GET['precioMin']) : '';
$precioMax    = isset($_GET['precioMax']) ? trim($_GET['precioMax']) : '';
$fechaDesde   = isset($_GET['fechaDesde']) ? trim($_GET['fechaDesde']) : '';
$fechaHasta   = isset($_GET['fechaHasta']) ? trim($_GET['fechaHasta']) : '';

$hayFiltros = ($searchRapida !== '' || $tipoAnuncio !== '' || $ciudad !== '' || $precioMax !== '');

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <!-- Requisito estricto de la Práctica 7 (Página 3): Mostrar los datos reales introducidos -->
        <section style="background-color: var(--color-superficie); border-left: 4px solid var(--color-primario);">
            <h2><i class="fa-solid fa-filter" role="img" aria-label="Filtros"></i> Criterios de búsqueda introducidos</h2>
            <p>El servidor PHP ha procesado los siguientes parámetros enviados desde el formulario:</p>

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
            <p style="font-size: 0.85rem; color: var(--color-texto-suave);">
                <em>(En una próxima práctica estos parámetros filtrarán registros reales en la base de datos MySQL).</em>
            </p>
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
        </section>

        <section>
            <p>
                <a href="formBusqueda.php<?= $esRegistrado ? '?usuario=' . urlencode($usuarioActual) : ''; ?>" class="conBorde"><i class="fa-solid fa-sliders" role="img" aria-label="Modificar"></i> Modificar filtros de búsqueda</a>
                <a href="index.php" class="conBorde"><i class="fa-solid fa-house" role="img" aria-label="Inicio"></i> Volver al inicio</a>
            </p>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
