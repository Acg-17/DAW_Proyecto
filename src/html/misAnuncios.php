<?php
/**
 * Página "Mis anuncios" - HabitaQ
 */
require_once(__DIR__ . '/../php/funciones.php');
$anuncios = require(__DIR__ . '/../php/datos_anuncios.php');

$usuarioActual = isset($_GET['usuario']) ? trim($_GET['usuario']) : 'Pau';
$title = 'Mis Anuncios Publicados';
$esRegistrado = true;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <header>
            <div>
                <h2><i class="fa-solid fa-list-check" role="img" aria-label="Anuncios"></i> Mis anuncios publicados</h2>
                <p>Gestiona las propiedades que tienes activas en el portal.</p>
            </div>
            <a href="crearAnuncio.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-plus" role="img" aria-label="Crear"></i> Publicar nuevo anuncio</a>
        </header>

        <section>
            <h3>Inmuebles registrados a tu nombre</h3>
            <p>Se muestran los anuncios asociados a tu cuenta (<?= e($usuarioActual); ?>):</p>

            <table style="width: 100%; margin-top: 1rem;">
                <caption>Listado de propiedades publicadas</caption>
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Título</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 110px;">
                            <img src="<?= e($anuncios['impar']['fotoPrincipal']); ?>" alt="<?= e($anuncios['impar']['titulo']); ?>" width="90" style="border-radius: 4px; object-fit: cover; height: 60px;">
                        </td>
                        <td>
                            <strong><?= e($anuncios['impar']['titulo']); ?></strong><br>
                            <small><?= e($anuncios['impar']['tipoAnuncio']); ?> &bull; <?= e($anuncios['impar']['tipoVivienda']); ?></small>
                        </td>
                        <td><?= e($anuncios['impar']['ciudad']); ?>, <?= e($anuncios['impar']['pais']); ?></td>
                        <td><strong><?= e($anuncios['impar']['precio']); ?></strong></td>
                        <td>
                            <a href="verAnuncio.php?id=1&usuario=<?= urlencode($usuarioActual); ?>" class="conBorde" style="display: inline-block; margin-bottom: 0.35rem;"><i class="fa-solid fa-eye" role="img" aria-label="Ver"></i> Ver detalle</a>
                            <a href="anadirFoto.php?id=1&usuario=<?= urlencode($usuarioActual); ?>" class="conBorde" style="display: inline-block;"><i class="fa-solid fa-camera" role="img" aria-label="Foto"></i> Añadir foto</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 110px;">
                            <img src="<?= e($anuncios['par']['fotoPrincipal']); ?>" alt="<?= e($anuncios['par']['titulo']); ?>" width="90" style="border-radius: 4px; object-fit: cover; height: 60px;">
                        </td>
                        <td>
                            <strong><?= e($anuncios['par']['titulo']); ?></strong><br>
                            <small><?= e($anuncios['par']['tipoAnuncio']); ?> &bull; <?= e($anuncios['par']['tipoVivienda']); ?></small>
                        </td>
                        <td><?= e($anuncios['par']['ciudad']); ?>, <?= e($anuncios['par']['pais']); ?></td>
                        <td><strong><?= e($anuncios['par']['precio']); ?></strong></td>
                        <td>
                            <a href="verAnuncio.php?id=2&usuario=<?= urlencode($usuarioActual); ?>" class="conBorde" style="display: inline-block; margin-bottom: 0.35rem;"><i class="fa-solid fa-eye" role="img" aria-label="Ver"></i> Ver detalle</a>
                            <a href="anadirFoto.php?id=2&usuario=<?= urlencode($usuarioActual); ?>" class="conBorde" style="display: inline-block;"><i class="fa-solid fa-camera" role="img" aria-label="Foto"></i> Añadir foto</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-user" role="img" aria-label="Perfil"></i> Panel de usuario</a>
                <a href="crearAnuncio.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-plus" role="img" aria-label="Crear"></i> Publicar nuevo anuncio</a>
            </div>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
