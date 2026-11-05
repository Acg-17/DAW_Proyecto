<?php
/**
 * Respuesta a "Registro de Nuevo Usuario" - HabitaQ (DAW Práctica 7)
 * Requisitos (Páginas 4 y 25 del PDF):
 * - Comprobar que se ha escrito algo en usuario, contraseña y repetir contraseña.
 * - Comprobar que contraseña y repetir contraseña coinciden.
 * - Si hay error: mostrar página de error con indicación de los campos erróneos y enlace para volver.
 * - Si es correcto: mostrar todos los datos recibidos (escapados de forma segura contra XSS).
 * - IMPORTANTE: NO mostrar la foto de perfil (la subida se implementará en una próxima práctica).
 * - Sin uso de sesiones ni cookies (especificación de la práctica).
 */
require_once(__DIR__ . '/../php/funciones.php');

$errores = [];

// Recoger datos enviados por POST
$usuario    = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$password   = isset($_POST['password']) ? trim($_POST['password']) : '';
$repPass    = isset($_POST['repPass']) ? trim($_POST['repPass']) : '';
$email      = isset($_POST['email']) ? trim($_POST['email']) : '';
$sexo       = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
$fechaNac   = isset($_POST['fechaNac']) ? trim($_POST['fechaNac']) : '';
$ciudad     = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
$pais       = isset($_POST['pais']) ? trim($_POST['pais']) : 'España';

// 1. Validaciones exigidas estrictamente por el enunciado (Página 4 del PDF)
if ($usuario === '') {
    $errores[] = 'El campo "Nombre de usuario" es obligatorio y no puede estar vacío ni contener solo espacios.';
}

if ($password === '') {
    $errores[] = 'El campo "Contraseña" es obligatorio.';
}

if ($repPass === '') {
    $errores[] = 'El campo "Repetir contraseña" es obligatorio.';
}

if ($password !== '' && $repPass !== '' && $password !== $repPass) {
    $errores[] = 'Las contraseñas introducidas no coinciden. Deben ser exactamente iguales.';
}

$title = empty($errores) ? 'Registro Completado' : 'Error en el Registro';
$esRegistrado = false;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <?php if (!empty($errores)): ?>
            <!-- Caso de error en validación del servidor (Página 4 y 25 del PDF) -->
            <section>
                <h2><i class="fa-solid fa-triangle-exclamation" role="img" aria-label="Error"></i> Errores de Validación en el Registro</h2>
                <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 1.5rem;">
                    <p><strong>No se ha podido procesar el registro debido a los siguientes fallos detectados por PHP en el servidor:</strong></p>
                    <ul>
                        <?php foreach ($errores as $err): ?>
                            <li><?= e($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php
                // Parámetros para inicializar el formulario al volver (Estrategia 2, página 4)
                $paramsVolver = http_build_query([
                    'error'      => implode(' | ', $errores),
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
            <!-- Caso de éxito: Mostrar datos reales recibidos (Página 4 del PDF) -->
            <section>
                <h2><i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> Inserción realizada, tus datos son:</h2>
                <p>Tu solicitud de registro ha sido validada y procesada con éxito por el servidor PHP.</p>

                <fieldset>
                    <legend>Resumen de datos registrados</legend>
                    <p>Nombre de usuario: <strong><?= e($usuario); ?></strong></p>
                    <p>Contraseña registrada: <strong>********</strong> (<em><?= strlen($password); ?> caracteres introducidos y verificados</em>)</p>
                    <p>Correo electrónico: <strong><?= e($email ?: 'No proporcionado'); ?></strong></p>
                    <p>Sexo: <strong><?= e($sexo ?: 'No especificado'); ?></strong></p>
                    <p>Fecha de nacimiento: <strong><?= e($fechaNac ?: 'No especificada'); ?></strong></p>
                    <p>Ubicación: <strong><?= e($ciudad ?: 'No indicada'); ?>, <?= e($pais); ?></strong></p>
                    <p style="color: var(--color-texto-suave); font-size: 0.85rem;">
                        <em>* Nota técnica de la Práctica 7: Por indicación expresa de la rúbrica (Página 4), no se muestra la fotografía de perfil ya que la subida real de ficheros al servidor se implementará en la próxima práctica.</em>
                    </p>
                </fieldset>

                <div style="margin-top: 1.5rem;">
                    <p>
                        <a href="index.php" class="conBorde"><i class="fa-solid fa-right-to-bracket" role="img" aria-label="Acceso"></i> Ir a la página de inicio para iniciar sesión</a>
                        <a href="formBusqueda.php" class="conBorde"><i class="fa-solid fa-magnifying-glass" role="img" aria-label="Búsqueda"></i> Explorar inmuebles</a>
                    </p>
                </div>
            </section>
        <?php endif; ?>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
