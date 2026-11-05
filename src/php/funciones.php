<?php
/**
 * Funciones auxiliares y de seguridad - HabitaQ (DAW Práctica 7)
 */

/**
 * Función de escape contra ataques XSS (Cross-Site Scripting)
 * Cumple con la Sección 4.6 (Página 11) de la Práctica 7
 *
 * @param mixed $value
 * @return string
 */
function e($value)
{
    if ($value === null) {
        return '';
    }
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Cálculo oficial de tarifas de folletos publicitarios en PHP
 * Cumple con la Sección 3 (Página 2) y la Figura 2 (Página 3)
 *
 * Tarifas base:
 * - Coste procesamiento y envío base: 10.00 €
 * - Menos de 5 páginas (< 5): 2.00 € / pág
 * - Entre 5 y 10 páginas (5 a 10): 1.80 € / pág
 * - Más de 10 páginas (> 10): 1.60 € / pág
 * - Fotos por página: 3 fotos
 * - Blanco y negro: 0.00 € / foto
 * - Color: 0.50 € / foto
 * - Resolución <= 300 dpi: 0.00 € / foto
 * - Resolución > 300 dpi (450-900 dpi): 0.20 € / foto
 *
 * @param int $paginas Número de páginas (1 a 15)
 * @param bool $color Si es a color (true) o blanco y negro (false)
 * @param int $resolucion Resolución en DPI (ej. 150, 300, 450, 600, 900)
 * @param int $copias Número de copias impresas (mínimo 1)
 * @return array Desglose detallado y total
 */
function calcularTarifaFolleto($paginas = 3, $color = false, $resolucion = 300, $copias = 1)
{
    $paginas = max(1, min(15, (int)$paginas));
    $copias = max(1, min(99, (int)$copias));
    $fotos = $paginas * 3;

    $precioBase = 10.0;
    $costePaginas = 0.0;

    for ($i = 1; $i <= $paginas; $i++) {
        if ($i < 5) {
            $costePaginas += 2.0;
        } elseif ($i <= 10) {
            $costePaginas += 1.8;
        } else {
            $costePaginas += 1.6;
        }
    }

    $extraColorPorFoto = $color ? 0.5 : 0.0;
    $extraDpiPorFoto = ($resolucion > 300) ? 0.2 : 0.0;
    $costeFotos = ($extraColorPorFoto + $extraDpiPorFoto) * $fotos;

    $costeUnitario = $precioBase + $costePaginas + $costeFotos;
    $costeTotal = $costeUnitario * $copias;

    return [
        'paginas'        => $paginas,
        'fotos'          => $fotos,
        'color'          => $color,
        'resolucion'     => $resolucion,
        'copias'         => $copias,
        'precioBase'     => $precioBase,
        'costePaginas'   => $costePaginas,
        'costeFotos'     => $costeFotos,
        'costeUnitario'  => $costeUnitario,
        'costeTotal'     => $costeTotal
    ];
}
