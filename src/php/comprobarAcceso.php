<?php

// Cargar los usuarios permitidos
$usuariosPermitidos = require(__DIR__ . '/datos_usuarios.php');

// Obtener el usuario desde GET o POST
$usuarioActual = '';

if (isset($_GET['usuario'])) {
    $usuarioActual = trim($_GET['usuario']);
} elseif (isset($_POST['usuario'])) {
    $usuarioActual = trim($_POST['usuario']);
}

// Comprobar que el usuario existe
$usuarioEncontrado = null;

foreach ($usuariosPermitidos as $usuario) {
    if (strcasecmp($usuario['usuario'], $usuarioActual) === 0) {
        $usuarioEncontrado = $usuario;
        break;
    }
}

// Si no existe o no se ha indicado, redirigir
if ($usuarioEncontrado === null) {
    $mensajeError = urlencode(
        'Debes acceder mediante el formulario de inicio de sesión.'
    );

    header('Location: index.php?error=' . $mensajeError);
    exit;
}

// Utilizar el nombre oficial del usuario
$usuarioActual = $usuarioEncontrado['usuario'];