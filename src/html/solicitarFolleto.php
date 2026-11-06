<?php
/**
 * Página "Solicitar folleto" - HabitaQ
 */
require_once(__DIR__ . '/../php/comprobarAcceso.php');
require_once(__DIR__ . '/../php/funciones.php');

$esRegistrado = ($usuarioActual !== '');
$title = 'Solicitar Folleto Publicitario';

$extraScripts = '
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var slider = document.getElementById("res");
            var output = document.getElementById("resValor");
            if (slider && output) {
                slider.addEventListener("input", function () {
                    output.textContent = slider.value + " DPI";
                });
            }
        });
    </script>
    <script src="../js/preciosFolleto.js" defer></script>
';

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-print" role="img" aria-label="Impresión"></i> Solicitud de impresión de folleto publicitario</h2>
            <p>Mediante esta opción puedes solicitar la impresión y envío postal de uno de tus anuncios a todo color y a máxima resolución.</p>

            <h3>Tarifas Vigentes de Impresión y Envío</h3>
            <table>
                <caption>Tarifas base aplicadas en el cálculo</caption>
                <thead>
                    <tr>
                        <th scope="col">Concepto</th>
                        <th scope="col">Tarifa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Coste procesamiento y envío base</td>
                        <td>10,00 €</td>
                    </tr>
                    <tr>
                        <td>Menos de 5 páginas (&lt; 5)</td>
                        <td>2,00 € por pág.</td>
                    </tr>
                    <tr>
                        <td>Entre 5 y 10 páginas</td>
                        <td>1,80 € por pág.</td>
                    </tr>
                    <tr>
                        <td>Más de 10 páginas (&gt; 10)</td>
                        <td>1,60 € por pág.</td>
                    </tr>
                    <tr>
                        <td>Blanco y negro</td>
                        <td>0,00 € (incluido)</td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td>0,50 € por foto</td>
                    </tr>
                    <tr>
                        <td>Resolución &le; 300 dpi</td>
                        <td>0,00 € (incluido)</td>
                    </tr>
                    <tr>
                        <td>Resolución &gt; 300 dpi (450-900 dpi)</td>
                        <td>0,20 € por foto</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section>
            <h3><i class="fa-solid fa-calculator" role="img" aria-label="Cálculo"></i> Tabla con posibles costes de un folleto</h3>
            <p>A continuación se detallan los costes orientativos según el número de páginas, selección de color y resolución:</p>

            <table>
                <caption>Posibles costes de un folleto impreso según páginas, color y resolución</caption>
                <thead>
                    <tr>
                        <th rowspan="2" scope="col">Número de páginas</th>
                        <th rowspan="2" scope="col">Número de fotos</th>
                        <th colspan="2" scope="colgroup" style="text-align: center;">Blanco y negro</th>
                        <th colspan="2" scope="colgroup" style="text-align: center;">Color</th>
                    </tr>
                    <tr>
                        <th scope="col">150-300 dpi</th>
                        <th scope="col">450-900 dpi</th>
                        <th scope="col">150-300 dpi</th>
                        <th scope="col">450-900 dpi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($p = 1; $p <= 15; $p++): ?>
                        <?php
                            $cBnLow    = calcularTarifaFolleto($p, false, 300, 1)['costeUnitario'];
                            $cBnHigh   = calcularTarifaFolleto($p, false, 600, 1)['costeUnitario'];
                            $cColLow   = calcularTarifaFolleto($p, true, 300, 1)['costeUnitario'];
                            $cColHigh  = calcularTarifaFolleto($p, true, 600, 1)['costeUnitario'];
                        ?>
                        <tr>
                            <td><?= $p; ?></td>
                            <td><?= $p * 3; ?></td>
                            <td><?= number_format($cBnLow, 2, ',', '.'); ?> €</td>
                            <td><?= number_format($cBnHigh, 2, ',', '.'); ?> €</td>
                            <td><?= number_format($cColLow, 2, ',', '.'); ?> €</td>
                            <td><?= number_format($cColHigh, 2, ',', '.'); ?> €</td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </section>

        <!-- Tabla interactiva de costes -->
        <section id="tablaPrecios">
            <h3>Tabla interactiva de costes</h3>
            <p>Puedes consultar o alternar la visualización de la tabla interactiva de tarifas a continuación:</p>
            <button id="botonTablaPrecios" type="button" class="btn-tabla-toggle">Ocultar</button>
        </section>

        <section>
            <h3>Formulario de solicitud</h3>
            <p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu folleto publicitario. Los campos marcados con asterisco son obligatorios.</p>

            <form action="respuestaFolleto.php" method="post" novalidate>
                <?php if ($esRegistrado): ?>
                    <input type="hidden" name="usuario" value="<?= e($usuarioActual); ?>">
                <?php endif; ?>

                <fieldset>
                    <legend>Información personal</legend>

                    <label for="nombre">Nombre completo: *</label>
                    <input type="text" id="nombre" name="nombre" maxlength="200" placeholder="Tu nombre y apellidos">

                    <label for="email">&#9993; Correo electrónico: *</label>
                    <input type="email" id="email" name="email" maxlength="200" placeholder="correo@ejemplo.com">

                    <fieldset>
                        <legend>Dirección de entrega</legend>
                        
                        <label for="calle">Calle / Avenida: *</label>
                        <input type="text" id="calle" name="calle">

                        <label for="numero">Número: *</label>
                        <input type="text" id="numero" name="numero">

                        <label for="portal">Portal:</label>
                        <input type="text" id="portal" name="portal">

                        <label for="piso">Piso:</label>
                        <input type="text" id="piso" name="piso">

                        <label for="letra">Letra / Puerta:</label>
                        <input type="text" id="letra" name="letra">

                        <label for="cp">Código Postal: *</label>
                        <input type="text" id="cp" name="cp" placeholder="03001">

                        <label for="localidad">Localidad / Municipio: *</label>
                        <input type="text" id="localidad" name="localidad">

                        <label for="provincia">Provincia: *</label>
                        <input type="text" id="provincia" name="provincia">
                    </fieldset>

                    <label for="tel">&#9742; Teléfono de contacto:</label>
                    <input type="tel" id="tel" name="tel" placeholder="+34 600 000 000">
                </fieldset>

                <fieldset>
                    <legend>Configuración del folleto</legend>

                    <label for="col">Color de la portada:</label>
                    <input type="color" id="col" name="col" value="#0f172a">

                    <label for="copias">Número de copias (1 - 99): *</label>
                    <input type="number" id="copias" name="copias" min="1" max="99" value="1">

                    <label for="res">Resolución de impresión: *</label>
                    <input type="range" id="res" name="res" min="150" max="900" step="150" value="300" list="valoresRes">
                    <output id="resValor" for="res">300 DPI</output>

                    <datalist id="valoresRes">
                        <option value="150" label="150 DPI"></option>
                        <option value="300" label="300 DPI"></option>
                        <option value="450" label="450 DPI"></option>
                        <option value="600" label="600 DPI"></option>
                        <option value="750" label="750 DPI"></option>
                        <option value="900" label="900 DPI"></option>
                    </datalist>

                    <label for="color_modo">Impresión de fotografías: *</label>
                    <select name="color_modo" id="color_modo">
                        <option value="bn">Blanco y negro (0,00 € extra)</option>
                        <option value="color" selected>A todo color (+0,50 € por fotografía)</option>
                    </select>

                    <label for="anuncioId">Anuncio a imprimir: *</label>
                    <select name="anuncioId" id="anuncioId">
                        <option value="1">Anuncio #1: Casa moderna con jardín (Valencia)</option>
                        <option value="2">Anuncio #2: Chalet junto al mar (Alicante)</option>
                    </select>

                    <label for="fechaRecepcion">Fecha deseada de recepción:</label>
                    <input type="date" id="fechaRecepcion" name="fechaRecepcion">

                    <input type="submit" value="Calcular y Solicitar Folleto &rarr;">
                </fieldset>
            </form>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
