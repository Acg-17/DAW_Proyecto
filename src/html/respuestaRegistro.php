<?php
/**
 * Respuesta a "Registro de Nuevo Usuario" - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');
$usuariosExistentes = require(__DIR__ . '/../php/datos_usuarios.php');

// Recoger datos del formulario de registro por POST
$usuario     = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$password    = isset($_POST['password']) ? $_POST['password'] : '';
$repPass     = isset($_POST['repPass']) ? $_POST['repPass'] : '';
$email       = isset($_POST['email']) ? trim($_POST['email']) : '';
$sexo        = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
$fechaNac    = isset($_POST['nacimiento']) ? trim($_POST['nacimiento']) : '';
$ciudad      = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
$pais        = isset($_POST['pais']) ? trim($_POST['pais']) : 'España';

$errores = [];

// Validaciones en servidor
if ($usuario === '') {
    $errores[] = 'El nombre de usuario es obligatorio y no puede estar vacío ni contener solo espacios.';
}

if ($password === '') {
    $errores[] = 'La contraseña es obligatoria y no puede estar vacía.';
}

if ($password !== $repPass) {
    $errores[] = 'Las contraseñas introducidas no coinciden. Por favor, asegúrate de escribir la misma contraseña en ambos campos.';
}

if ($email === '') {
    $errores[] = 'La dirección de correo electrónico es obligatoria.';
}

if ($sexo === '') {
    $errores[] = 'Debes seleccionar una opción de sexo.';
}

$title = empty($errores) ? 'Registro Completado' : 'Error en el Registro';
$esRegistrado = false;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <?php if (!empty($errores)): ?>
            <section>
                <h2><i class="fa-solid fa-triangle-exclamation" role="img" aria-label="Error"></i> Errores en la solicitud de registro</h2>
                <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 1.5rem;">
                    <p><strong>Por favor, corrige los siguientes problemas antes de continuar:</strong></p>
                    <ul>
                        <?php foreach ($errores as $err): ?>
                            <li><?= e($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php
                $paramsVolver = http_build_query([
                    'error'      => implode(' ', $errores),
                    'usuario'    => $usuario,
                    'email'      => $email,
                    'sexo'       => $sexo,
                    'nacimiento' => $fechaNac,
                    'ciudad'     => $ciudad,
                    'pais'       => $pais
                ]);
                ?>
                <p>
                    <a href="registro.php?<?= $paramsVolver; ?>" class="conBorde"><i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Volver a corregir los datos en el formulario</a>
                </p>
            </section>
        <?php else: ?>
            <section>
                <h2><i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> Registro realizado, tus datos son:</h2>
                <p>Tu cuenta ha sido creada y procesada con éxito.</p>

                <fieldset>
                    <legend>Resumen de datos registrados</legend>
                    <p>Nombre de usuario: <strong><?= e($usuario); ?></strong></p>
                    <p>Contraseña registrada: <strong>********</strong> (<em><?= strlen($password); ?> caracteres introducidos y verificados</em>)</p>
                    <p>Correo electrónico: <strong><?= e($email ?: 'No proporcionado'); ?></strong></p>
                    <p>Sexo: <strong><?= e($sexo ?: 'No especificado'); ?></strong></p>
                    <p>Fecha de nacimiento: <strong><?= e($fechaNac ?: 'No especificada'); ?></strong></p>
                    <p>Ubicación: <strong><?= e($ciudad ?: 'No indicada'); ?>, <?= e($pais); ?></strong></p>
                </fieldset>

                <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="index.php" class="conBorde"><i class="fa-solid fa-right-to-bracket" role="img" aria-label="Acceso"></i> Ir a la página de inicio para iniciar sesión</a>
                    <a href="formBusqueda.php" class="conBorde"><i class="fa-solid fa-magnifying-glass" role="img" aria-label="Búsqueda"></i> Explorar inmuebles</a>
                </div>
            </section>
        <?php endif; ?>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
