<?php
/**
 * Página "Crear anuncio" - HabitaQ
 */
require_once(__DIR__ . '/../php/comprobarAcceso.php');
require_once(__DIR__ . '/../php/funciones.php');

$title = 'Publicar Nuevo Anuncio';
$esRegistrado = true;

// Procesar recepción del nuevo anuncio
$mensajeExito = false;
$datosRecibidos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosRecibidos = [
        'tipoAnuncio'  => isset($_POST['tipoAnuncio']) ? trim($_POST['tipoAnuncio']) : '',
        'tipoVivienda' => isset($_POST['tipoVivienda']) ? trim($_POST['tipoVivienda']) : '',
        'titulo'       => isset($_POST['titulo']) ? trim($_POST['titulo']) : '',
        'precio'       => isset($_POST['precio']) ? trim($_POST['precio']) : '',
        'superficie'   => isset($_POST['superficie']) ? trim($_POST['superficie']) : '',
        'habitaciones' => isset($_POST['habitaciones']) ? trim($_POST['habitaciones']) : '',
        'banos'        => isset($_POST['banos']) ? trim($_POST['banos']) : '',
        'planta'       => isset($_POST['planta']) ? trim($_POST['planta']) : '',
        'anyo'         => isset($_POST['anyo']) ? trim($_POST['anyo']) : '',
        'ciudad'       => isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '',
        'pais'         => isset($_POST['pais']) ? trim($_POST['pais']) : '',
        'descripcion'  => isset($_POST['descripcion']) ? trim($_POST['descripcion']) : ''
    ];
    $mensajeExito = true;
}

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <section>
            <h2><i class="fa-solid fa-circle-plus" role="img" aria-label="Crear"></i> Publicar Nuevo Anuncio</h2>
            <p>Rellena las especificaciones del inmueble para ponerlo a la venta o en alquiler en la plataforma.</p>

            <?php if ($mensajeExito): ?>
                <div class="mensaje-exito" role="status" style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px; border: 1px solid #86efac; margin-bottom: 1.5rem;">
                    <h3><i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> ¡Anuncio publicado correctamente!</h3>
                    <p>Tu anuncio ha sido recibido y registrado con los siguientes datos:</p>
                    <ul>
                        <li>Título: <strong><?= e($datosRecibidos['titulo']); ?></strong></li>
                        <li>Operación: <strong><?= e($datosRecibidos['tipoAnuncio']); ?></strong> &bull; Tipo: <strong><?= e($datosRecibidos['tipoVivienda']); ?></strong></li>
                        <li>Precio: <strong><?= e($datosRecibidos['precio']); ?> €</strong></li>
                        <li>Ubicación: <strong><?= e($datosRecibidos['ciudad']); ?>, <?= e($datosRecibidos['pais']); ?></strong></li>
                        <li>Superficie: <strong><?= e($datosRecibidos['superficie']); ?> m²</strong> &bull; Habitaciones: <strong><?= e($datosRecibidos['habitaciones']); ?></strong> &bull; Baños: <strong><?= e($datosRecibidos['banos']); ?></strong></li>
                        <li>Descripción: <em><?= e($datosRecibidos['descripcion']); ?></em></li>
                    </ul>
                    <p style="margin-top: 1rem;"><a href="misAnuncios.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde">Ir a mis anuncios</a></p>
                </div>
            <?php endif; ?>

            <form method="post" action="crearAnuncio.php?usuario=<?= urlencode($usuarioActual); ?>" novalidate>
                <fieldset>
                    <legend>Información general del anuncio</legend>

                    <label for="titulo">Título descriptivo del anuncio: *</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Ej: Ático de lujo con terraza panorámica" required>

                    <label for="tipoAnuncio">Tipo de operación: *</label>
                    <select name="tipoAnuncio" id="tipoAnuncio">
                        <option value="Venta">Venta</option>
                        <option value="Alquiler">Alquiler</option>
                    </select>

                    <label for="tipoVivienda">Tipo de vivienda: *</label>
                    <select name="tipoVivienda" id="tipoVivienda">
                        <option value="Piso">Piso</option>
                        <option value="Chalet">Chalet</option>
                        <option value="Ático">Ático</option>
                        <option value="Dúplex">Dúplex</option>
                        <option value="Casa rústica">Casa rústica</option>
                    </select>

                    <label for="precio">Precio (€): *</label>
                    <input type="number" name="precio" id="precio" placeholder="Ej: 285000" min="0" step="500">
                </fieldset>

                <fieldset>
                    <legend>Ubicación del inmueble</legend>

                    <label for="ciudad">Ciudad / Municipio: *</label>
                    <input type="text" name="ciudad" id="ciudad" placeholder="Ej: Valencia">

                    <label for="pais">País: *</label>
                    <input type="text" name="pais" id="pais" value="España">
                </fieldset>

                <fieldset>
                    <legend>Características de la propiedad</legend>

                    <label for="superficie">Superficie útil (m²): *</label>
                    <input type="number" name="superficie" id="superficie" placeholder="Ej: 120" min="10">

                    <label for="habitaciones">Número de habitaciones:</label>
                    <input type="number" name="habitaciones" id="habitaciones" min="0" max="20" value="3">

                    <label for="banos">Número de baños:</label>
                    <input type="number" name="banos" id="banos" min="0" max="10" value="2">

                    <label for="planta">Planta / Altura:</label>
                    <input type="text" name="planta" id="planta" placeholder="Ej: 4ª planta exterior">

                    <label for="anyo">Año de construcción:</label>
                    <input type="number" name="anyo" id="anyo" min="1900" max="2030" value="2020">

                    <label for="descripcion">Descripción detallada: *</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Describe los puntos fuertes del inmueble..."></textarea>
                </fieldset>

                <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                    <input type="submit" value="Publicar Inmueble &rarr;">
                    <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="btn-secundario">Cancelar y volver al panel</a>
                </div>
            </form>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
