<?php
/**
 * Página de Control de Acceso (No visible) - HabitaQ (DAW Práctica 7)
 * Requisitos:
 * - Valida en servidor que los campos no estén vacíos ni contengan solo espacios/tabuladores.
 * - Comprueba credenciales contra los 4 usuarios permitidos de datos_usuarios.php.
 * - Redirecciona con header() a menuUsuario.php si es correcto.
 * - Redirecciona con header() a index.php con mensaje de error si es incorrecto.
 * - SIN SESIONES NI COOKIES (Páginas 4 y 24 del PDF).
 */

require_once(__DIR__ . '/../php/funciones.php');
$usuariosPermitidos = require(__DIR__ . '/../php/datos_usuarios.php');

// Recoger datos por POST (o GET por fallback)
$username = isset($_POST['username']) ? trim($_POST['username']) : (isset($_GET['username']) ? trim($_GET['username']) : '');
$password = isset($_POST['password']) ? trim($_POST['password']) : (isset($_GET['password']) ? trim($_GET['password']) : '');

// 1. Validación de campos obligatorios (sin espacios en blanco o tabuladores)
if ($username === '' || $password === '') {
    $mensajeError = urlencode('Debes introducir el nombre de usuario y la contraseña (no se permiten campos vacíos ni únicamente espacios).');
    header("Location: index.php?error=$mensajeError&user=" . urlencode($username));
    exit;
}

// 2. Comprobación contra los 4 usuarios del almacén
$usuarioEncontrado = null;
foreach ($usuariosPermitidos as $u) {
    if (strcasecmp($u['usuario'], $username) === 0 && $u['password'] === $password) {
        $usuarioEncontrado = $u;
        break;
    }
}

// 3. Redirección según resultado
if ($usuarioEncontrado !== null) {
    // Usuario registrado correcto -> menú de usuario registrado
    header("Location: menuUsuario.php?usuario=" . urlencode($usuarioEncontrado['usuario']));
    exit;
} else {
    // Credenciales incorrectas
    $mensajeError = urlencode('Nombre de usuario o contraseña incorrectos. Comprueba tus datos o regístrate si no tienes cuenta.');
    header("Location: index.php?error=$mensajeError&user=" . urlencode($username));
    exit;
}
