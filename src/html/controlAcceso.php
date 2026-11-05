<?php
/**
 * Página de Control de Acceso - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');
$usuariosPermitidos = require(__DIR__ . '/../php/datos_usuarios.php');

// Recoger datos por POST (o GET por fallback)
$username = isset($_POST['username']) ? trim($_POST['username']) : (isset($_GET['username']) ? trim($_GET['username']) : '');
$password = isset($_POST['password']) ? trim($_POST['password']) : (isset($_GET['password']) ? trim($_GET['password']) : '');

// 1. Validación de campos obligatorios
if ($username === '' || $password === '') {
    $mensajeError = urlencode('Debes introducir el nombre de usuario y la contraseña (no se permiten campos vacíos ni únicamente espacios).');
    header("Location: index.php?error=$mensajeError&user=" . urlencode($username));
    exit;
}

// 2. Comprobación contra los usuarios registrados
$usuarioEncontrado = null;
foreach ($usuariosPermitidos as $u) {
    if (strcasecmp($u['usuario'], $username) === 0 && $u['password'] === $password) {
        $usuarioEncontrado = $u;
        break;
    }
}

// 3. Redirección según resultado
if ($usuarioEncontrado !== null) {
    header("Location: menuUsuario.php?usuario=" . urlencode($usuarioEncontrado['usuario']));
    exit;
} else {
    $mensajeError = urlencode('Nombre de usuario o contraseña incorrectos. Comprueba tus datos o regístrate si no tienes cuenta.');
    header("Location: index.php?error=$mensajeError&user=" . urlencode($username));
    exit;
}
