<?php
/**
 * Respuesta a "Enviar Mensaje" - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');

$tiposValidos = [
    'info'   => 'Más información sobre el inmueble',
    'cita'   => 'Solicitar una cita para visita',
    'oferta' => 'Comunicar una oferta económica'
];

// Recoger datos enviados por POST
$anuncioId       = isset($_POST['anuncioId']) ? (int)$_POST['anuncioId'] : 1;
$anuncioTitulo   = isset($_POST['anuncioTitulo']) ? trim($_POST['anuncioTitulo']) : 'Inmueble HabitaQ';
$destinatario    = isset($_POST['destinatario']) ? trim($_POST['destinatario']) : 'Propietario';
$nombreRemitente = isset($_POST['nombreRemitente']) ? trim($_POST['nombreRemitente']) : '';
$emailRemitente  = isset($_POST['emailRemitente']) ? trim($_POST['emailRemitente']) : '';
$messageType     = isset($_POST['messageType']) ? trim($_POST['messageType']) : '';
$message         = isset($_POST['message']) ? trim($_POST['message']) : '';
$usuarioActual   = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';

$errores = [];

if ($messageType === '' || !array_key_exists($messageType, $tiposValidos)) {
    $errores[] = 'El tipo de comunicación seleccionado no es válido.';
}

if ($message === '') {
    $errores[] = 'El contenido del mensaje es obligatorio y no puede estar vacío ni contener solo espacios.';
}

$title = empty($errores) ? 'Mensaje Enviado' : 'Error al Enviar Mensaje';
$esRegistrado = ($usuarioActual !== '');

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <?php if (!empty($errores)): ?>
            <section>
                <h2><i class="fa-solid fa-triangle-exclamation" role="img" aria-label="Error"></i> No se pudo enviar el mensaje</h2>
                <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 1.5rem;">
                    <p><strong>Por favor, corrige los siguientes problemas:</strong></p>
                    <ul>
                        <?php foreach ($errores as $err): ?>
                            <li><?= e($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <p>
                    <a href="javascript:history.back()" class="conBorde"><i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Volver al formulario de mensaje</a>
                </p>
            </section>
        <?php else: ?>
            <section>
                <h2><i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> Confirmación de Envío de Mensaje</h2>
                <p><strong>¡Tu mensaje ha sido enviado con éxito al anunciante!</strong></p>

                <fieldset>
                    <legend>Resumen de la comunicación</legend>
                    <p>Destinatario / Propietario: <strong><?= e($destinatario); ?></strong></p>
                    <p>Inmueble de referencia: <strong><?= e($anuncioTitulo); ?> (#<?= $anuncioId; ?>)</strong></p>
                    <p>Remitente: <strong><?= e($nombreRemitente ?: 'Usuario anónimo'); ?></strong> (<?= e($emailRemitente ?: 'Sin correo indicado'); ?>)</p>
                    <p>Tipo de comunicación: <strong><?= e($tiposValidos[$messageType]); ?></strong></p>
                    <p>Texto del mensaje:</p>
                    <blockquote style="background: var(--color-fondo); border-left: 4px solid var(--color-primario); padding: 0.75rem 1rem; margin: 0.5rem 0; border-radius: 4px;">
                        <?= nl2br(e($message)); ?>
                    </blockquote>
                    <p style="font-size: 0.85rem; color: var(--color-texto-suave);">
                        Fecha y hora del envío: <strong><?= date('d/m/Y - H:i:s'); ?></strong>
                    </p>
                </fieldset>

                <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="detalleAdd.php?id=<?= $anuncioId; ?><?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>" class="conBorde">
                        <i class="fa-solid fa-house" role="img" aria-label="Anuncio"></i> Volver a la ficha del inmueble
                    </a>
                    <a href="index.php" class="conBorde">
                        <i class="fa-solid fa-house-chimney" role="img" aria-label="Inicio"></i> Ir a la página principal
                    </a>
                </div>
            </section>
        <?php endif; ?>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
