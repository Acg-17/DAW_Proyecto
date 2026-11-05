<?php
/**
 * Página "Crear anuncio" - HabitaQ (DAW Práctica 7)
 * Requisitos (Página 4 y Figura 1 del PDF):
 * - Contiene un formulario con los datos necesarios para crear un anuncio:
 *   Título, texto/descripción, tipo de anuncio, tipo de vivienda, ciudad, país, precio y características.
 */
require_once(__DIR__ . '/../php/funciones.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : 'Laura';
$title = 'Crear Anuncio';
$esRegistrado = true;

$mensajeExito = false;
$datosRecibidos = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensajeExito = true;
    $datosRecibidos = [
        'titulo'       => isset($_POST['titulo']) ? trim($_POST['titulo']) : '',
        'tipoAnuncio'  => isset($_POST['tipoAnuncio']) ? trim($_POST['tipoAnuncio']) : '',
        'tipoVivienda' => isset($_POST['tipoVivienda']) ? trim($_POST['tipoVivienda']) : '',
        'precio'       => isset($_POST['precio']) ? trim($_POST['precio']) : '',
        'ciudad'       => isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '',
        'pais'         => isset($_POST['pais']) ? trim($_POST['pais']) : '',
        'superficie'   => isset($_POST['superficie']) ? trim($_POST['superficie']) : '',
        'habitaciones' => isset($_POST['habitaciones']) ? trim($_POST['habitaciones']) : '',
        'banos'        => isset($_POST['banos']) ? trim($_POST['banos']) : '',
        'descripcion'  => isset($_POST['descripcion']) ? trim($_POST['descripcion']) : ''
    ];
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
                    <h3><i class="fa-solid fa-circle-check" role="img" aria-label="Éxito"></i> ¡Anuncio procesado por el servidor!</h3>
                    <p>Los datos han sido recibidos correctamente mediante PHP (en próximas prácticas se almacenarán en la base de datos):</p>
                    <ul>
                        <li>Título: <strong><?= e($datosRecibidos['titulo']); ?></strong></li>
                        <li>Operación: <strong><?= e($datosRecibidos['tipoAnuncio']); ?></strong> &bull; Tipo: <strong><?= e($datosRecibidos['tipoVivienda']); ?></strong></li>
                        <li>Precio: <strong><?= e($datosRecibidos['precio']); ?> €</strong></li>
                        <li>Ubicación: <strong><?= e($datosRecibidos['ciudad']); ?>, <?= e($datosRecibidos['pais']); ?></strong></li>
                        <li>Superficie: <strong><?= e($datosRecibidos['superficie']); ?> m²</strong> &bull; Habitaciones: <strong><?= e($datosRecibidos['habitaciones']); ?></strong> &bull; Baños: <strong><?= e($datosRecibidos['banos']); ?></strong></li>
                        <li>Descripción: <em><?= e($datosRecibidos['descripcion']); ?></em></li>
                    </ul>
                    <p><a href="misAnuncios.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde">Ir a mis anuncios</a></p>
                </div>
            <?php endif; ?>

            <form method="post" action="crearAnuncio.php?usuario=<?= urlencode($usuarioActual); ?>" novalidate>
                <fieldset>
                    <legend>Información general del anuncio</legend>

                    <label for="titulo">Título del anuncio: *</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Ej. Piso céntrico y luminoso con terraza">

                    <label for="tipoAnuncio">Tipo de anuncio: *</label>
                    <select name="tipoAnuncio" id="tipoAnuncio">
                        <option value="Venta">Venta</option>
                        <option value="Alquiler">Alquiler</option>
                    </select>

                    <label for="tipoVivienda">Tipo de vivienda: *</label>
                    <select name="tipoVivienda" id="tipoVivienda">
                        <option value="Vivienda">Vivienda</option>
                        <option value="Chalet">Chalet</option>
                        <option value="Ático">Ático</option>
                        <option value="Dúplex">Dúplex</option>
                        <option value="Obra nueva">Obra nueva</option>
                        <option value="Local / Oficina">Local / Oficina</option>
                    </select>

                    <label for="precio">Precio (€): *</label>
                    <input type="number" id="precio" name="precio" placeholder="Ej. 250000">
                </fieldset>

                <fieldset>
                    <legend>Ubicación y características</legend>

                    <label for="ciudad">Ciudad: *</label>
                    <input type="text" id="ciudad" name="ciudad" placeholder="Valencia, Alicante, Madrid...">

                    <label for="pais">País: *</label>
                    <input type="text" id="pais" name="pais" value="España">

                    <label for="superficie">Superficie útil (m²):</label>
                    <input type="number" id="superficie" name="superficie" placeholder="Ej. 120">

                    <label for="habitaciones">Número de habitaciones:</label>
                    <input type="number" id="habitaciones" name="habitaciones" min="0" max="20" placeholder="Ej. 3">

                    <label for="banos">Número de baños:</label>
                    <input type="number" id="banos" name="banos" min="0" max="10" placeholder="Ej. 2">

                    <label for="descripcion">Descripción detallada del inmueble: *</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Explica las ventajas, calidades, orientación y entorno del inmueble..."></textarea>

                    <label for="fotoPrincipal">Foto principal:</label>
                    <input type="file" id="fotoPrincipal" name="fotoPrincipal">

                    <input type="submit" value="Publicar Anuncio &rarr;">
                </fieldset>
            </form>

            <div style="margin-top: 1rem;">
                <p>
                    <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Volver a mi perfil</a>
                    <a href="misAnuncios.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-list-check" role="img" aria-label="Anuncios"></i> Ver mis anuncios</a>
                </p>
            </div>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
