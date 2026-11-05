<?php
/**
 * Página "Añadir foto a anuncio" - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');
$anuncios = require(__DIR__ . '/../php/datos_anuncios.php');

$idFijo = isset($_GET['id']) ? (int)$_GET['id'] : null;
$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : 'Pau';
$title = 'Añadir Fotografía a Anuncio';
$esRegistrado = true;

// Procesar recepción de la imagen enviada
$mensajeEnviado = false;
$tituloFoto = '';
$textoAlt = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tituloFoto = isset($_POST['tituloFoto']) ? trim($_POST['tituloFoto']) : '';
    $textoAlt = isset($_POST['textoAlt']) ? trim($_POST['textoAlt']) : '';
    $anuncioId = isset($_POST['anuncio']) ? (int)$_POST['anuncio'] : ($idFijo ?: 1);
    $mensajeEnviado = true;
}

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-camera" role="img" aria-label="Foto"></i> Añadir Fotografía a Anuncio</h2>
            <p>Formulario para adjuntar imágenes complementarias a un anuncio ya publicado.</p>

            <?php if ($mensajeEnviado): ?>
                <div class="mensaje-exito" role="status" style="background-color: #dcfce7; color: #166534; padding: 0.75rem 1rem; border-radius: 6px; border: 1px solid #86efac; margin-bottom: 1rem;">
                    <i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> Fotografía adjuntada con éxito para el anuncio: <strong><?= e($tituloFoto ?: 'Sin título'); ?></strong> (Alt: "<?= e($textoAlt); ?>").
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
                        <select id="anuncio_bloqueado" disabled style="background-color: var(--color-fondo); color: var(--color-texto);">
                            <option selected>Anuncio #<?= $idFijo; ?>: <?= e($nombreAnuncioFijo); ?></option>
                        </select>
                        <input type="hidden" name="anuncio" value="<?= $idFijo; ?>">
                    <?php else: ?>
                        <select name="anuncio" id="anuncio">
                            <option value="" selected disabled>-- Selecciona un anuncio en el que incluir la foto --</option>
                            <option value="1">Anuncio #1: <?= e($anuncios['impar']['titulo']); ?> (Valencia)</option>
                            <option value="2">Anuncio #2: <?= e($anuncios['par']['titulo']); ?> (Alicante)</option>
                        </select>
                    <?php endif; ?>

                    <label for="foto">Archivo de imagen: *</label>
                    <input type="file" name="foto" id="foto" accept="image/*">

                    <label for="tituloFoto">Título de la foto: *</label>
                    <input type="text" name="tituloFoto" id="tituloFoto" placeholder="Ej: Salón principal luminoso, Terraza al atardecer...">

                    <label for="textoAlt">Texto alternativo (accesibilidad): *</label>
                    <input type="text" name="textoAlt" id="textoAlt" placeholder="Descripción breve de la foto para lectores de pantalla">

                    <input type="submit" value="Guardar Fotografía &rarr;">
                </fieldset>
            </form>

            <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                <?php if ($idFijo !== null): ?>
                    <a href="verAnuncio.php?id=<?= $idFijo; ?>&usuario=<?= urlencode($usuarioActual); ?>" class="conBorde">
                        <i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Volver a la ficha del anuncio
                    </a>
                <?php endif; ?>
                <a href="misAnuncios.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde">
                    <i class="fa-solid fa-list-check" role="img" aria-label="Mis Anuncios"></i> Ir a mis anuncios
                </a>
                <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde">
                    <i class="fa-solid fa-user" role="img" aria-label="Perfil"></i> Panel de usuario
                </a>
            </div>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
