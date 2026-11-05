<?php
/**
 * Página "Añadir foto a anuncio" - HabitaQ (DAW Práctica 7)
 * Requisitos (Página 4 del PDF):
 * - Formulario: archivo de foto, texto alternativo (mínimo 10 caracteres, Nota 10), título de la foto y anuncio al que se añade.
 * - Si se accede desde el menú privado: lista desplegable sin anuncio seleccionado por defecto.
 * - Si se accede desde "Mis anuncios" o "Ver anuncio" (?id=X): el anuncio ya aparece seleccionado y bloqueado/fijo (no se puede cambiar).
 * - En esta práctica no se realiza subida real ni página de respuesta (página 4).
 */
require_once(__DIR__ . '/../php/funciones.php');
$anuncios = require(__DIR__ . '/../php/datos_anuncios.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : 'Laura';
$idFijo = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Mensaje informativo tras enviar
$mensajeEnviado = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensajeEnviado = true;
    $tituloFoto = isset($_POST['tituloFoto']) ? trim($_POST['tituloFoto']) : '';
    $textoAlt = isset($_POST['textoAlt']) ? trim($_POST['textoAlt']) : '';
}

$title = 'Añadir Fotografía a Anuncio';
$esRegistrado = true;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-camera" role="img" aria-label="Foto"></i> Añadir Fotografía a Anuncio</h2>
            <p>Formulario para adjuntar imágenes complementarias a un anuncio ya publicado.</p>

            <?php if ($mensajeEnviado): ?>
                <div class="mensaje-exito" role="status" style="background-color: #dcfce7; color: #166534; padding: 0.75rem 1rem; border-radius: 6px; border: 1px solid #86efac; margin-bottom: 1rem;">
                    <i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> Datos de la fotografía recibidos para el anuncio: <strong><?= e($tituloFoto ?: 'Sin título'); ?></strong> (Alt: "<?= e($textoAlt); ?>"). <em>(En esta práctica no se realiza almacenamiento en disco según las especificaciones del PDF).</em>
                </div>
            <?php endif; ?>

            <form method="post" action="anadirFoto.php<?= $idFijo ? '?id=' . $idFijo . '&usuario=' . urlencode($usuarioActual) : '?usuario=' . urlencode($usuarioActual); ?>" novalidate>
                <fieldset>
                    <legend>Detalles de la fotografía</legend>

                    <label for="anuncio">Anuncio asociado: *</label>
                    <?php if ($idFijo !== null): ?>
                        <?php 
                            $nombreAnuncioFijo = ($idFijo % 2 === 0) ? $anuncios['par']['titulo'] : $anuncios['impar']['titulo'];
                        ?>
                        <!-- Anuncio prefijado y no modificable al provenir de "Mis anuncios" o "Ver anuncio" -->
                        <select id="anuncio_bloqueado" disabled style="background-color: var(--color-fondo); color: var(--color-texto);">
                            <option selected>Anuncio #<?= $idFijo; ?>: <?= e($nombreAnuncioFijo); ?></option>
                        </select>
                        <input type="hidden" name="anuncio" value="<?= $idFijo; ?>">
                        <small style="color: var(--color-texto-suave); display: block; margin-top: -0.25rem; margin-bottom: 0.5rem;">
                            <em>* Anuncio seleccionado automáticamente desde la ficha y fijado según el enunciado de la práctica.</em>
                        </small>
                    <?php else: ?>
                        <!-- Desplegable libre al acceder desde el menú de usuario -->
                        <select name="anuncio" id="anuncio">
                            <option value="" selected disabled>-- Selecciona un anuncio en el que incluir la foto --</option>
                            <option value="1">Anuncio #1: <?= e($anuncios['impar']['titulo']); ?> (Valencia)</option>
                            <option value="2">Anuncio #2: <?= e($anuncios['par']['titulo']); ?> (Alicante)</option>
                        </select>
                    <?php endif; ?>

                    <label for="tituloFoto">Título descriptivo de la imagen: *</label>
                    <input type="text" id="tituloFoto" name="tituloFoto" placeholder="Ej. Vista de la cocina reformada">

                    <label for="textoAlt">Texto alternativo de la imagen (mínimo 10 caracteres - Nota 10): *</label>
                    <input type="text" id="textoAlt" name="textoAlt" placeholder="Describe detalladamente el contenido de la imagen (mín. 10 caracteres)">

                    <label for="foto">Archivo de imagen: *</label>
                    <input type="file" id="foto" name="foto">

                    <input type="submit" value="Añadir Fotografía &rarr;">
                </fieldset>
            </form>

            <div style="margin-top: 1rem;">
                <p>
                    <a href="misAnuncios.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-list-check" role="img" aria-label="Anuncios"></i> Volver a mis anuncios</a>
                    <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-user" role="img" aria-label="Perfil"></i> Panel de usuario</a>
                </p>
            </div>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
