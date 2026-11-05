<?php
/**
 * Plantilla Base Modular PHP - HabitaQ (DAW Práctica 7)
 * Cumple con la Sección 4.4 (Páginas 8-9 del PDF):
 * Estructura dividida en cabecera, inicio (navegación), contenido y pie.
 */
require_once(__DIR__ . '/src/php/funciones.php');

$title = 'Título de Ejemplo';
$esRegistrado = false;

require_once(__DIR__ . '/src/php/cabecera.php');
require_once(__DIR__ . '/src/php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2>Contenido de la página</h2>
            <p>Este es el bloque central dinámico que varía de una página a otra.</p>
        </section>
    </main>

<?php
require_once(__DIR__ . '/src/php/pie.php');
?>
