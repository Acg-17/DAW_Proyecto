<?php
/**
 * Error Usuario No Registrado - HabitaQ (DAW Práctica 7)
 */
require_once(__DIR__ . '/../php/funciones.php');

$title = 'Acceso Restringido';
$esRegistrado = false;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-lock" role="img" aria-label="Bloqueado"></i> Acceso Restringido a Usuarios Registrados</h2>
            <p>Para ver todos los detalles de este inmueble o contactar con el propietario, es necesario iniciar sesión con una cuenta de usuario registrada.</p>
            <p>
                <a href="index.php" class="conBorde"><i class="fa-solid fa-right-to-bracket" role="img" aria-label="Acceder"></i> Iniciar sesión</a>
                <a href="registro.php" class="conBorde"><i class="fa-solid fa-user-plus" role="img" aria-label="Registrarse"></i> Crear cuenta nueva</a>
            </p>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
