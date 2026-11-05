<?php
/**
 * Formulario de Búsqueda Avanzada - HabitaQ (DAW Práctica 7)
 * Cumple con la Figura 1 (Páginas 2 y 3)
 */
require_once(__DIR__ . '/../php/funciones.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';
$esRegistrado = ($usuarioActual !== '');
$title = 'Búsqueda Avanzada';

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-sliders" role="img" aria-label="Filtros"></i> Búsqueda Avanzada de Inmuebles</h2>
            <p>Filtra según tus preferencias para encontrar el inmueble deseado. Los datos introducidos serán procesados por el servidor PHP en la página de resultados.</p>

            <form method="get" action="resultadoBusqueda.php" novalidate>
                <?php if ($esRegistrado): ?>
                    <input type="hidden" name="usuario" value="<?= e($usuarioActual); ?>">
                <?php endif; ?>

                <label for="tipoAnuncio">Tipo de anuncio</label>
                <select name="tipoAnuncio" id="tipoAnuncio">
                    <option value="todos">Todos los anuncios</option>
                    <option value="venta">Venta</option>
                    <option value="alquiler">Alquiler</option>
                </select>

                <label for="tipoVivienda">Tipo de vivienda</label>
                <select name="tipoVivienda" id="tipoVivienda">
                    <option value="todas">Cualquier tipo</option>
                    <option value="obraNueva">Obra nueva</option>
                    <option value="vivienda">Vivienda</option>
                    <option value="oficina">Oficina</option>
                    <option value="local">Local</option>
                    <option value="garaje">Garaje</option>
                </select>

                <label for="ciudad">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" placeholder="Introduce tu ciudad (ej. Valencia, Alicante...)">

                <label for="pais">País</label>
                <select name="pais" id="pais">
                    <option value="Espana">España</option>
                    <option value="Francia">Francia</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Italia">Italia</option>
                    <option value="Alemania">Alemania</option>
                    <option value="Reino Unido">Reino Unido</option>
                </select>

                <label for="precioMin">Precio mínimo (€)</label>
                <input type="number" name="precioMin" id="precioMin" placeholder="Ej. 100000" min="0" step="5000">

                <label for="precioMax">Precio máximo (€)</label>
                <input type="number" name="precioMax" id="precioMax" placeholder="Introduce el presupuesto máximo de tu vivienda" min="0" step="5000">

                <label for="fechaDesde">Fecha de publicación (Desde)</label>
                <input type="date" name="fechaDesde" id="fechaDesde">

                <label for="fechaHasta">Fecha de publicación (Hasta)</label>
                <input type="date" name="fechaHasta" id="fechaHasta">

                <input type="submit" value="Buscar Inmuebles &rarr;">
            </form>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
