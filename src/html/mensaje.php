<?php
/**
 * Página "Enviar Mensaje al Anunciante" - HabitaQ (DAW Práctica 7)
 * Cumple con la Figura 1 (Páginas 2 y 3)
 */
require_once(__DIR__ . '/../php/funciones.php');
$anuncios = require(__DIR__ . '/../php/datos_anuncios.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$clave = ($id % 2 === 0) ? 'par' : 'impar';
$anuncio = $anuncios[$clave];

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$esRegistrado = ($usuarioActual !== '');
$title = 'Contactar con el Anunciante';

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-paper-plane" role="img" aria-label="Contactar"></i> Contactar con el Anunciante</h2>
            <p>Envía tu consulta o propuesta directamente al propietario del inmueble: <strong><?= e($anuncio['titulo']); ?></strong> (<?= e($anuncio['ciudad']); ?>).</p>

            <form method="post" action="respuestaMensaje.php" novalidate>
                <input type="hidden" name="anuncioId" value="<?= $id; ?>">
                <input type="hidden" name="anuncioTitulo" value="<?= e($anuncio['titulo']); ?>">
                <input type="hidden" name="destinatario" value="<?= e($anuncio['usuario']); ?>">
                <?php if ($esRegistrado): ?>
                    <input type="hidden" name="usuario" value="<?= e($usuarioActual); ?>">
                <?php endif; ?>

                <fieldset>
                    <legend>Detalles del mensaje</legend>

                    <label for="nombreRemitente">Tu nombre completo: *</label>
                    <input type="text" name="nombreRemitente" id="nombreRemitente" value="<?= e($usuarioActual ?: ''); ?>" placeholder="Introduce tu nombre">

                    <label for="emailRemitente">Tu correo electrónico: *</label>
                    <input type="email" name="emailRemitente" id="emailRemitente" placeholder="nombre@correo.com">

                    <label for="messageType">Tipo de comunicación: *</label>
                    <select name="messageType" id="messageType">
                        <option value="info">Más información sobre el inmueble</option>
                        <option value="cita">Solicitar una cita para visita</option>
                        <option value="oferta">Comunicar una oferta económica</option>
                    </select>

                    <label for="message">Texto del mensaje: *</label>
                    <textarea name="message" id="message" placeholder="Escribe aquí tu consulta detallada..."></textarea>

                    <input type="submit" value="Enviar Mensaje &rarr;">
                </fieldset>
            </form>

            <p style="margin-top: 1rem;">
                <a href="detalleAdd.php?id=<?= $id; ?><?= $esRegistrado ? '&usuario=' . urlencode($usuarioActual) : ''; ?>" class="conBorde">
                    <i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Volver a la ficha del inmueble
                </a>
            </p>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
