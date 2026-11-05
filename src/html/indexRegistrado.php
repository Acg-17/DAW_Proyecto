<?php
/**
 * Página principal para usuario registrado - HabitaQ (DAW Práctica 7)
 */
require_once(__DIR__ . '/../php/funciones.php');
$usuarios = require(__DIR__ . '/../php/datos_usuarios.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : 'Laura';
$nombreMostrar = 'Laura García';
foreach ($usuarios as $u) {
    if (strcasecmp($u['usuario'], $usuarioActual) === 0) {
        $nombreMostrar = $u['nombre'];
        break;
    }
}

$title = 'Inicio (Usuario Registrado)';
$esRegistrado = true;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <header>
            <p>Bienvenido/a, <strong><?= e($nombreMostrar); ?></strong> (<a href="index.php">Salir</a>)</p>
            <form method="get" action="resultadoBusqueda.php">
                <input type="hidden" name="usuario" value="<?= e($usuarioActual); ?>">
                <input type="search" name="search" id="search" placeholder="Buscar por ciudad, zona..." aria-label="Buscar viviendas">
                <input type="submit" value="Buscar &rarr;" id="searchSubmit">
            </form>
        </header>

        <section>
            <h2>Últimos anuncios publicados</h2>
            <p>Listado actualizado de inmuebles disponibles en HabitaQ.</p>

            <a href="detalleAdd.php?id=1&usuario=<?= urlencode($usuarioActual); ?>">
                <article class="anuncio">
                    <img src="../img/casa1.png" alt="Casa moderna con jardín" width="200">
                    <h3>Casa moderna con jardín</h3>
                    <p>Valencia, España &bull; 15/09/2026</p>
                    <p><strong>285.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=2&usuario=<?= urlencode($usuarioActual); ?>">
                <article class="anuncio">
                    <img src="../img/casa2.png" alt="Chalet junto al mar" width="200">
                    <h3>Chalet junto al mar</h3>
                    <p>Alicante, España &bull; 18/09/2026</p>
                    <p><strong>420.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=3&usuario=<?= urlencode($usuarioActual); ?>">
                <article class="anuncio">
                    <img src="../img/casa3.png" alt="Casa rural de montaña" width="200">
                    <h3>Casa rural de montaña</h3>
                    <p>Granada, España &bull; 20/09/2026</p>
                    <p><strong>195.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=4&usuario=<?= urlencode($usuarioActual); ?>">
                <article class="anuncio">
                    <img src="../img/casa4.png" alt="Ático céntrico con terraza" width="200">
                    <h3>Ático céntrico con terraza</h3>
                    <p>Madrid, España &bull; 22/09/2026</p>
                    <p><strong>310.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=5&usuario=<?= urlencode($usuarioActual); ?>">
                <article class="anuncio">
                    <img src="../img/casa5.png" alt="Dúplex de diseño" width="200">
                    <h3>Dúplex de diseño</h3>
                    <p>Barcelona, España &bull; 25/09/2026</p>
                    <p><strong>380.000 €</strong></p>
                </article>
            </a>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
