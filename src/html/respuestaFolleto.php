<?php
/**
 * Respuesta a "Solicitar Folleto" - HabitaQ (DAW Práctica 7)
 * Requisitos (Página 2 del PDF):
 * - Muestra confirmación de que se ha registrado la solicitud de folleto.
 * - Muestra el coste final calculado en PHP a partir de la solicitud del usuario.
 * - Emplea valores ficticios para el número de páginas y de fotos (ya que aún no hay BD de fotos).
 * - Tiene en cuenta el resto de parámetros del usuario: color/BN, resolución DPI, número de copias.
 * - El número de copias multiplica el precio unitario.
 */
require_once(__DIR__ . '/../php/funciones.php');

// Recoger datos de solicitud (por POST o GET)
$origen = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;

$nombre     = isset($origen['nombre']) ? trim($origen['nombre']) : 'Usuario Anónimo';
$email      = isset($origen['email']) ? trim($origen['email']) : '';
$calle      = isset($origen['calle']) ? trim($origen['calle']) : '';
$numero     = isset($origen['numero']) ? trim($origen['numero']) : '';
$portal     = isset($origen['portal']) ? trim($origen['portal']) : '';
$piso       = isset($origen['piso']) ? trim($origen['piso']) : '';
$letra      = isset($origen['letra']) ? trim($origen['letra']) : '';
$cp         = isset($origen['cp']) ? trim($origen['cp']) : '';
$localidad  = isset($origen['localidad']) ? trim($origen['localidad']) : '';
$provincia  = isset($origen['provincia']) ? trim($origen['provincia']) : '';
$tel        = isset($origen['tel']) ? trim($origen['tel']) : '';
$col        = isset($origen['col']) ? trim($origen['col']) : '#0f172a';
$copias     = isset($origen['copias']) ? max(1, (int)$origen['copias']) : 1;
$res        = isset($origen['res']) ? (int)$origen['res'] : 300;
$colorModo  = isset($origen['color_modo']) ? $origen['color_modo'] : 'color';
$anuncioId  = isset($origen['anuncioId']) ? (int)$origen['anuncioId'] : 1;
$usuarioActual = isset($origen['usuario']) ? trim($origen['usuario']) : '';

// Parámetros ficticios de páginas y fotos exigidos por el enunciado (Página 2)
$paginasFicticias = 4; // Por ejemplo, un folleto díptico estándar de 4 páginas
$fotosFicticias = $paginasFicticias * 3; // 12 fotografías
$esColor = ($colorModo === 'color');

// Cálculo mediante la función oficial de tarifas en PHP
$calculo = calcularTarifaFolleto($paginasFicticias, $esColor, $res, $copias);

$title = 'Confirmación de Solicitud de Folleto';
$esRegistrado = ($usuarioActual !== '');

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-circle-check" role="img" aria-label="Confirmado"></i> Solicitud de Folleto Registrada</h2>
            <p><strong>¡Tu solicitud ha sido recibida y procesada correctamente por el servidor!</strong></p>

            <fieldset>
                <legend>Datos de la entrega y destinatario</legend>
                <p>Destinatario: <strong><?= e($nombre); ?></strong></p>
                <p>Correo de confirmación: <strong><?= e($email ?: 'No proporcionado'); ?></strong> &bull; Teléfono: <strong><?= e($tel ?: 'No indicado'); ?></strong></p>
                <p>Dirección de envío: 
                    <strong>
                        <?= e($calle); ?> nº <?= e($numero); ?>
                        <?= $portal ? ', Portal ' . e($portal) : ''; ?>
                        <?= $piso ? ', ' . e($piso) . 'º' : ''; ?>
                        <?= $letra ? ' ' . e($letra) : ''; ?>
                        &bull; <?= e($cp); ?> <?= e($localidad); ?> (<?= e($provincia); ?>)
                    </strong>
                </p>
            </fieldset>

            <fieldset>
                <legend>Detalles técnicos del folleto publicitario</legend>
                <p>Anuncio seleccionado: <strong>Anuncio #<?= $anuncioId; ?></strong></p>
                <p>Número de páginas (ficticio según rúbrica): <strong><?= $paginasFicticias; ?> páginas</strong></p>
                <p>Número de fotografías (3 fotos por pág.): <strong><?= $fotosFicticias; ?> fotografías</strong></p>
                <p>Modo de impresión: <strong><?= $esColor ? 'A todo color' : 'Blanco y negro'; ?></strong></p>
                <p>Resolución seleccionada: <strong><?= $res; ?> DPI</strong> (<em><?= ($res > 300) ? 'Alta resolución' : 'Resolución estándar'; ?></em>)</p>
                <p>Color de portada seleccionado: <span style="display: inline-block; width: 24px; height: 16px; background-color: <?= e($col); ?>; vertical-align: middle; border: 1px solid #000; border-radius: 2px;"></span> <code><?= e($col); ?></code></p>
                <p>Número de copias solicitadas: <strong><?= $copias; ?></strong></p>
            </fieldset>

            <!-- REQUISITO EXIGIDO: Coste final calculado mediante PHP -->
            <fieldset>
                <legend><i class="fa-solid fa-receipt" role="img" aria-label="Factura"></i> Presupuesto final calculado por PHP</legend>
                <table>
                    <caption>Desglose del coste unitario y total</caption>
                    <thead>
                        <tr>
                            <th scope="col">Concepto de tarifa</th>
                            <th scope="col">Base de cálculo</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Coste fijo de procesamiento y envío base</td>
                            <td>Tarifa fija inicial</td>
                            <td><?= number_format($calculo['precioBase'], 2, ',', '.'); ?> €</td>
                        </tr>
                        <tr>
                            <td>Coste de impresión de páginas</td>
                            <td><?= $paginasFicticias; ?> páginas &times; 2,00 €</td>
                            <td><?= number_format($calculo['costePaginas'], 2, ',', '.'); ?> €</td>
                        </tr>
                        <tr>
                            <td>Suplemento por fotos (Color: <?= $esColor ? '+0,50€' : '0€'; ?> &bull; Alta Res: <?= ($res > 300) ? '+0,20€' : '0€'; ?>)</td>
                            <td><?= $fotosFicticias; ?> fotos &times; <?= number_format(($esColor ? 0.5 : 0) + (($res > 300) ? 0.2 : 0), 2, ',', '.'); ?> €</td>
                            <td><?= number_format($calculo['costeFotos'], 2, ',', '.'); ?> €</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" scope="row">Precio unitario por folleto:</th>
                            <td><strong><?= number_format($calculo['costeUnitario'], 2, ',', '.'); ?> €</strong></td>
                        </tr>
                        <tr>
                            <th colspan="2" scope="row">COSTE FINAL TOTAL (<?= $copias; ?> <?= ($copias > 1) ? 'copias' : 'copia'; ?>):</th>
                            <td style="font-size: 1.2rem; color: var(--color-texto);"><strong><?= number_format($calculo['costeTotal'], 2, ',', '.'); ?> €</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </fieldset>

            <div style="margin-top: 1.5rem;">
                <p>
                    <a href="solicitarFolleto.php<?= $esRegistrado ? '?usuario=' . urlencode($usuarioActual) : ''; ?>" class="conBorde">
                        <i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Solicitar otro folleto
                    </a>
                    <a href="index.php" class="conBorde">
                        <i class="fa-solid fa-house" role="img" aria-label="Inicio"></i> Volver a la página principal
                    </a>
                </p>
            </div>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
