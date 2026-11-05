<?php
/**
 * Página principal pública - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');

$title = 'Inicio';
$esRegistrado = false;

// Manejo de posibles mensajes de error devueltos por el control de acceso
$mensajeError = isset($_GET['error']) ? trim($_GET['error']) : '';
$usuarioPrevio = isset($_GET['user']) ? trim($_GET['user']) : '';

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <header>
            <a href="registro.php" class="conBorde"><i class="fa-solid fa-user-plus" role="img" aria-label="Registro"></i> Registrarse</a>
            <form method="get" action="resultadoBusqueda.php">
                <input type="search" name="search" id="search" placeholder="Buscar por ciudad, zona..." aria-label="Buscar viviendas">
                <input type="submit" value="Buscar &rarr;" id="searchSubmit">
            </form>
        </header>

        <aside>
            <h3><i class="fa-solid fa-user-lock" role="img" aria-label="Acceso"></i> Acceso Usuarios</h3>

            <?php if ($mensajeError !== ''): ?>
                <div class="mensaje-error" role="alert" style="background-color: #fee2e2; color: #991b1b; padding: 0.75rem 1rem; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 1rem; font-size: 0.9rem;">
                    <i class="fa-solid fa-triangle-exclamation" role="img" aria-label="Aviso"></i> <?= e($mensajeError); ?>
                </div>
            <?php endif; ?>

            <form id="formLogin" method="post" action="controlAcceso.php" novalidate>
                <label for="username">Nombre de usuario</label>
                <input type="text" name="username" id="username" value="<?= e($usuarioPrevio); ?>">

                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">

                <input type="submit" value="Entrar" id="loginSubmit">
            </form>
        </aside>

        <section>
            <h2>Últimos anuncios</h2>
            <p>Descubre las novedades más destacadas publicadas recientemente en HabitaQ.</p>

            <a href="detalleAdd.php?id=1">
                <article class="anuncio">
                    <img src="../img/casa1.png" alt="Casa moderna con jardín" width="200">
                    <h3>Casa moderna con jardín</h3>
                    <p>Valencia, España &bull; 15/09/2026</p>
                    <p><strong>285.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=2">
                <article class="anuncio">
                    <img src="../img/casa2.png" alt="Chalet junto al mar" width="200">
                    <h3>Chalet junto al mar</h3>
                    <p>Alicante, España &bull; 18/09/2026</p>
                    <p><strong>420.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=3">
                <article class="anuncio">
                    <img src="../img/casa3.png" alt="Casa rural de montaña" width="200">
                    <h3>Casa rural de montaña</h3>
                    <p>Granada, España &bull; 20/09/2026</p>
                    <p><strong>195.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=4">
                <article class="anuncio">
                    <img src="../img/casa4.png" alt="Ático céntrico con terraza" width="200">
                    <h3>Ático céntrico con terraza</h3>
                    <p>Madrid, España &bull; 22/09/2026</p>
                    <p><strong>310.000 €</strong></p>
                </article>
            </a>

            <a href="detalleAdd.php?id=5">
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
