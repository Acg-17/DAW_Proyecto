<?php
/**
 * Error 404 - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');

$title = 'Página no encontrada (Error 404)';
$esRegistrado = false;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-triangle-exclamation" role="img" aria-label="Error 404"></i> Error 404: Página no encontrada</h2>
            <p>La dirección web que has solicitado no existe o ha sido trasladada.</p>
            <p>
                <a href="index.php" class="conBorde"><i class="fa-solid fa-house" role="img" aria-label="Inicio"></i> Volver a la página principal</a>
            </p>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
