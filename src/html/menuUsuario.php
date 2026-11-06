<?php
/**
 * Página de Menú de Usuario Registrado - HabitaQ
 */
require_once(__DIR__ . '/../php/comprobarAcceso.php');
require_once(__DIR__ . '/../php/funciones.php');
$usuarios = require(__DIR__ . '/../php/datos_usuarios.php');

if ($usuarioActual === '') {
    $usuarioActual = 'Pau';
}

// Buscar datos del usuario
$datosUsuario = null;
foreach ($usuarios as $u) {
    if (strcasecmp($u['usuario'], $usuarioActual) === 0) {
        $datosUsuario = $u;
        break;
    }
}
if ($datosUsuario === null) {
    $datosUsuario = $usuarios[0]; // Fallback al primer usuario
}

// Mensaje de actualización simulada si se envía el formulario
$mensajeExito = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'actualizar') {
    $datosUsuario['nombre'] = isset($_POST['nombre']) ? trim($_POST['nombre']) : $datosUsuario['nombre'];
    $datosUsuario['email'] = isset($_POST['email']) ? trim($_POST['email']) : $datosUsuario['email'];
    $datosUsuario['sexo'] = isset($_POST['sexo']) ? trim($_POST['sexo']) : $datosUsuario['sexo'];
    $datosUsuario['ciudad'] = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : $datosUsuario['ciudad'];
    $mensajeExito = 'Tus datos personales se han actualizado correctamente.';
}

$title = 'Mi Perfil - ' . $datosUsuario['nombre'];
$esRegistrado = true;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section id="userSection">
            <h2><i class="fa-solid fa-id-card" role="img" aria-label="Perfil"></i> Información del usuario registrado</h2>

            <?php if ($mensajeExito !== ''): ?>
                <div class="mensaje-exito" role="status" style="background-color: #dcfce7; color: #166534; padding: 0.75rem 1rem; border-radius: 6px; border: 1px solid #86efac; margin-bottom: 1rem;">
                    <i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> <?= e($mensajeExito); ?>
                </div>
            <?php endif; ?>

            <article>
                <img src="../img/user.png" alt="Foto de perfil de <?= e($datosUsuario['nombre']); ?>" class="avatar-usuario" style="width: 120px; height: 120px; max-width: 120px; max-height: 120px; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 50%; border: 3px solid var(--color-primario); display: block; margin-bottom: 1rem;">
                <p>Usuario: <strong><?= e($datosUsuario['usuario']); ?></strong></p>
                <p>Nombre y apellidos: <strong><?= e($datosUsuario['nombre']); ?></strong></p>
                <p>Correo electrónico: <strong><?= e($datosUsuario['email']); ?></strong></p>
                <p>Sexo: <strong><?= e($datosUsuario['sexo']); ?></strong></p>
                <p>Fecha de nacimiento: <strong><?= e($datosUsuario['nacimiento']); ?></strong></p>
                <p>Ubicación: <strong><?= e($datosUsuario['ciudad']); ?>, <?= e($datosUsuario['pais']); ?></strong></p>
            </article>

            <!-- Formulario para modificar datos -->
            <form method="post" action="menuUsuario.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>" novalidate style="margin-top: 1.5rem;">
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="usuario" value="<?= e($datosUsuario['usuario']); ?>">

                <fieldset>
                    <legend><i class="fa-solid fa-user-pen" role="img" aria-label="Editar"></i> Modificar datos del perfil</legend>

                    <label for="nombre">Nombre completo</label>
                    <input type="text" name="nombre" id="nombre" value="<?= e($datosUsuario['nombre']); ?>">

                    <label for="email">Correo electrónico</label>
                    <input type="email" name="email" id="email" value="<?= e($datosUsuario['email']); ?>">

                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo">
                        <option value="Hombre" <?= ($datosUsuario['sexo'] === 'Hombre') ? 'selected' : ''; ?>>Hombre</option>
                        <option value="Mujer" <?= ($datosUsuario['sexo'] === 'Mujer') ? 'selected' : ''; ?>>Mujer</option>
                        <option value="No binario" <?= ($datosUsuario['sexo'] === 'No binario') ? 'selected' : ''; ?>>No binario</option>
                        <option value="Prefiero no responder" <?= ($datosUsuario['sexo'] === 'Prefiero no responder') ? 'selected' : ''; ?>>Prefiero no responder</option>
                    </select>

                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" value="<?= e($datosUsuario['ciudad']); ?>">

                    <input type="submit" value="Guardar cambios">
                </fieldset>
            </form>
        </section>

        <section id="panelAcciones">
            <h2><i class="fa-solid fa-compass" role="img" aria-label="Opciones"></i> Panel de Gestión</h2>
            <p>
                <a href="crearAnuncio.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>" class="conBorde"><i class="fa-solid fa-circle-plus" role="img" aria-label="Crear"></i> Publicar nuevo anuncio</a>
                <a href="misAnuncios.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>" class="conBorde"><i class="fa-solid fa-list-check" role="img" aria-label="Mis Anuncios"></i> Mis anuncios</a>
                <a href="anadirFoto.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>" class="conBorde"><i class="fa-solid fa-camera" role="img" aria-label="Fotos"></i> Añadir foto a anuncio</a>
                <a href="misMensajes.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>" class="conBorde"><i class="fa-solid fa-envelope" role="img" aria-label="Mensajes"></i> Centro de mensajes</a>
                <a href="solicitarFolleto.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>" class="conBorde"><i class="fa-solid fa-book-open" role="img" aria-label="Folleto"></i> Solicitar folleto impreso</a>
            </p>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
