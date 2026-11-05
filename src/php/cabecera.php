<?php
/**
 * Cabecera HTML y metadatos comunes - HabitaQ (DAW Práctica 7)
 * Cumple con la Sección 4.4 (Páginas 8-9): Fichero modular independiente
 */
if (!isset($title)) {
    $title = 'Portal Inmobiliario';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabitaQ - <?= htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></title>
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/estilos.css">

    <!-- Estilos principal y alternativos (Práctica 4: CSS) -->
    <link rel="stylesheet" type="text/css" href="../css/variables.css" title="Estilo principal" />
    <link rel="alternate stylesheet" type="text/css" href="../css/variables-oscuro.css" title="Tema oscuro / Modo noche" />
    <link rel="alternate stylesheet" type="text/css" href="../css/variables-letra-grande.css" title="Letras grandes" />
    <link rel="alternate stylesheet" type="text/css" href="../css/variables-contraste.css" title="Alto contraste" />
    <link rel="alternate stylesheet" type="text/css" href="../css/variables-accesibilidad-combinada.css" title="Alto contraste + Letras grandes" />
    <link rel="alternate stylesheet" type="text/css" href="../css/variables-impresion.css" title="Modo de impresión" />
    <?php if (!empty($extraScripts)): ?>
        <?= $extraScripts; ?>
    <?php endif; ?>
</head>
