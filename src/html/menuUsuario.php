<?php
/**
 * Página de Menú de Usuario Registrado - HabitaQ (DAW Práctica 7)
 * Cumple con la Figura 1 (Páginas 2 y 4)
 */
require_once(__DIR__ . '/../php/funciones.php');
$usuarios = require(__DIR__ . '/../php/datos_usuarios.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : (isset($_POST['usuario']) ? trim($_POST['usuario']) : 'Laura');
if ($usuarioActual === '') {
    $usuarioActual = 'Laura';
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
    $mensajeExito = 'Tus datos personales se han actualizado correctamente en el servidor.';
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

            <form id="datosUser" method="post" action="menuUsuario.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>" novalidate>
                <input type="hidden" name="accion" value="actualizar">
                <input type="hidden" name="usuario" value="<?= e($datosUsuario['usuario']); ?>">

                <fieldset>
                    <legend>Datos personales de la cuenta</legend>

                    <label for="usuario">Nombre de usuario (identificador):</label>
                    <input type="text" id="usuario" name="usuario_mostrar" value="<?= e($datosUsuario['usuario']); ?>" readonly style="background-color: var(--color-fondo);">

                    <label for="nombre">Nombre completo:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= e($datosUsuario['nombre']); ?>">

                    <label for="email">&#9993; Dirección de correo:</label>
                    <input type="email" id="email" name="email" value="<?= e($datosUsuario['email']); ?>">

                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo">
                        <option value="Hombre" <?= ($datosUsuario['sexo'] === 'Hombre') ? 'selected' : ''; ?>>Hombre</option>
                        <option value="Mujer" <?= ($datosUsuario['sexo'] === 'Mujer') ? 'selected' : ''; ?>>Mujer</option>
                        <option value="Otro" <?= ($datosUsuario['sexo'] === 'Otro') ? 'selected' : ''; ?>>Otro</option>
                        <option value="Prefiero no especificarlo" <?= ($datosUsuario['sexo'] === 'Prefiero no especificarlo') ? 'selected' : ''; ?>>Prefiero no especificarlo</option>
                    </select>

                    <label for="ciudad">Ciudad de residencia:</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?= e($datosUsuario['ciudad']); ?>">

                    <label for="pais">País:</label>
                    <input type="text" id="pais" name="pais" value="<?= e($datosUsuario['pais']); ?>" readonly style="background-color: var(--color-fondo);">

                    <label for="foto">Foto de perfil:</label>
                    <input type="file" name="foto" id="foto">
                    <img src="../img/user.png" alt="Foto de perfil de <?= e($datosUsuario['nombre']); ?>" width="100">

                    <input type="submit" value="Guardar Cambios &rarr;">
                </fieldset>
            </form>

            <form method="get" action="index.php" style="margin-top: 1rem;">
                <button type="submit" onclick="return confirm('¿Seguro que deseas solicitar la baja del portal?');"><i class="fa-solid fa-user-xmark" role="img" aria-label="Baja"></i> Darse de baja</button>
            </form>
        </section>

        <section>
            <h2><i class="fa-solid fa-gear" role="img" aria-label="Opciones"></i> Panel de Gestión del Usuario</h2>
            <p>Accede a las opciones de tu cuenta según el diagrama de navegación de la aplicación:</p>
            <p><a href="misAnuncios.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>"><i class="fa-solid fa-list-check" role="img" aria-label="Mis Anuncios"></i> <strong>Mis anuncios</strong> (gestionar y ver anuncios propios)</a></p>
            <p><a href="crearAnuncio.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>"><i class="fa-solid fa-circle-plus" role="img" aria-label="Crear anuncio"></i> <strong>Crear anuncio</strong> (publicar nuevo inmueble)</a></p>
            <p><a href="anadirFoto.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>"><i class="fa-solid fa-image" role="img" aria-label="Añadir foto"></i> <strong>Añadir foto a anuncio</strong> (seleccionar anuncio)</a></p>
            <p><a href="misMensajes.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>"><i class="fa-solid fa-envelope" role="img" aria-label="Mensajes"></i> <strong>Mis mensajes</strong> (buzón de entrada y salida)</a></p>
            <p><a href="solicitarFolleto.php?usuario=<?= urlencode($datosUsuario['usuario']); ?>"><i class="fa-solid fa-print" role="img" aria-label="Folleto"></i> <strong>Solicitar folleto publicitario</strong> (cálculo en PHP)</a></p>
            <p><a href="index.php"><i class="fa-solid fa-right-from-bracket" role="img" aria-label="Salir"></i> <strong>Salir</strong> (cerrar sesión)</a></p>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
