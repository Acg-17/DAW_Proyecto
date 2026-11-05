<?php
/**
 * Formulario de Registro de Nuevo Usuario - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');

$title = 'Registro de Nuevo Usuario';
$esRegistrado = false;

// Recuperar posibles errores y valores previos pasados por URL
$mensajeError = isset($_GET['error']) ? trim($_GET['error']) : '';
$valUsuario = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$valEmail = isset($_GET['email']) ? trim($_GET['email']) : '';
$valSexo = isset($_GET['sexo']) ? trim($_GET['sexo']) : '';
$valNacimiento = isset($_GET['nacimiento']) ? trim($_GET['nacimiento']) : '';
$valCiudad = isset($_GET['ciudad']) ? trim($_GET['ciudad']) : '';
$valPais = isset($_GET['pais']) ? trim($_GET['pais']) : 'España';

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-user-plus" role="img" aria-label="Registro"></i> Crear una Cuenta en HabitaQ</h2>
            <p>Únete a HabitaQ para publicar anuncios y contactar con propietarios de forma directa. Los campos marcados con asterisco (*) son obligatorios.</p>

            <?php if ($mensajeError !== ''): ?>
                <div class="mensaje-error" role="alert" style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 1.5rem;">
                    <h3><i class="fa-solid fa-triangle-exclamation" role="img" aria-label="Error"></i> Errores en el formulario de registro:</h3>
                    <p><?= e($mensajeError); ?></p>
                    <small>Por favor, revisa los campos señalados a continuación y vuelve a enviar el formulario.</small>
                </div>
            <?php endif; ?>

            <form id="formRegistro" method="post" action="respuestaRegistro.php" novalidate>
                <fieldset>
                    <legend>Datos de acceso y personales</legend>

                    <label for="usuario">Nombre de usuario: *</label>
                    <input type="text" id="usuario" name="usuario" value="<?= e($valUsuario); ?>" placeholder="Tu nombre de usuario">

                    <label for="password">Contraseña: *</label>
                    <input type="password" id="password" name="password" placeholder="Introduce tu contraseña">

                    <label for="repPass">Repetir contraseña: *</label>
                    <input type="password" id="repPass" name="repPass" placeholder="Vuelve a introducir la misma contraseña">

                    <label for="email">Dirección de correo electrónico: *</label>
                    <input type="email" id="email" name="email" value="<?= e($valEmail); ?>" placeholder="nombre@correo.com">

                    <label for="sexo">Sexo: *</label>
                    <select name="sexo" id="sexo">
                        <option value="" disabled <?= ($valSexo === '') ? 'selected' : ''; ?>>Selecciona una opción</option>
                        <option value="Hombre" <?= ($valSexo === 'Hombre') ? 'selected' : ''; ?>>Hombre</option>
                        <option value="Mujer" <?= ($valSexo === 'Mujer') ? 'selected' : ''; ?>>Mujer</option>
                        <option value="No binario" <?= ($valSexo === 'No binario') ? 'selected' : ''; ?>>No binario</option>
                        <option value="Prefiero no responder" <?= ($valSexo === 'Prefiero no responder') ? 'selected' : ''; ?>>Prefiero no responder</option>
                    </select>

                    <label for="nacimiento">Fecha de nacimiento:</label>
                    <input type="date" id="nacimiento" name="nacimiento" value="<?= e($valNacimiento); ?>">

                    <label for="ciudad">Ciudad de residencia:</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?= e($valCiudad); ?>" placeholder="Ej: Alicante">

                    <label for="pais">País:</label>
                    <input type="text" id="pais" name="pais" value="<?= e($valPais); ?>">

                    <label for="foto">Foto de perfil (opcional):</label>
                    <input type="file" id="foto" name="foto" accept="image/*">

                    <input type="submit" value="Completar Registro &rarr;">
                </fieldset>
            </form>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
