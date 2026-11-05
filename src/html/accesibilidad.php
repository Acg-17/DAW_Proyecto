<?php
/**
 * Declaración de Accesibilidad - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');

$title = 'Declaración de Accesibilidad';
$esRegistrado = false;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2>Declaración de Accesibilidad</h2>
            <p>HabitaQ está comprometido con la accesibilidad universal conforme a las pautas WCAG 2.1 (Niveles AA y AAA) y las Directivas (UE) 2016/2102 y 2019/882.</p>

            <h3>Etiquetado semántico de la página</h3>
            <p>Estructuración basada en HTML5 mediante regiones de referencia (<code>header</code>, <code>nav</code>, <code>main</code>, <code>section</code>, <code>article</code>, <code>aside</code>, <code>footer</code>). Los formularios emplean <code>fieldset</code>, <code>legend</code> y etiquetas <code>label</code> asociadas por <code>id</code>, manteniendo una jerarquía lógica de encabezados.</p>

            <h3>Texto alternativo de las imágenes</h3>
            <p>Todas las imágenes significativas cuentan con texto alternativo detallado en el atributo <code>alt</code>. Los iconos de Font Awesome disponen de <code>role="img"</code> y <code>aria-label</code> o <code>aria-hidden</code> para evitar interferencias con lectores de pantalla.</p>

            <h3>Correcto uso de los colores</h3>
            <p>La información no se transmite exclusivamente a través del color. Los esquemas cumplen los ratios de contraste WCAG AA (mínimo 4.5:1) y AAA (mínimo 7:1 en alto contraste), garantizando plena legibilidad a personas con daltonismo.</p>

            <h3>Activación de las hojas de estilo accesibles</h3>
            <p>El usuario puede alternar la presentación visual desde las opciones del navegador:</p>
            <ul>
                <li><strong>Mozilla Firefox:</strong> Pulsa la tecla <code>Alt</code> &rarr; Menú <em>Ver</em> &rarr; <em>Estilo de página</em> &rarr; Selecciona <em>Estilo principal</em>, <em>Tema oscuro / Modo noche</em>, <em>Letras grandes</em>, <em>Alto contraste</em>, <em>Alto contraste + Letras grandes</em> o <em>Modo de impresión</em>.</li>
                <li><strong>Google Chrome y Microsoft Edge:</strong> Mediante extensiones de alternate stylesheets o a través de las herramientas de desarrollador (<code>F12</code> &rarr; pestaña <em>Rendering</em>).</li>
            </ul>

            <h3>Otras características implementadas</h3>
            <ul>
                <li><strong>Enlace accesible de salto:</strong> Permite omitir la cabecera e ir directo a <code>#contenido-principal</code> mediante navegación por teclado (tecla Tab).</li>
                <li><strong>Formularios accesibles:</strong> Agrupación lógica con <code>fieldset</code> y <code>legend</code>, y etiquetado explícito mediante <code>for</code> e <code>id</code>.</li>
                <li><strong>Diseño responsivo:</strong> Adaptable a cualquier dispositivo y resolución (móviles, tablets, escritorios y pantallas panorámicas).</li>
                <li><strong>Impresión optimizada:</strong> Hoja de estilo específica para impresión con texto negro y eliminación de menús interactivos.</li>
            </ul>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
