<?php
/**
 * Página "Mis mensajes" - HabitaQ
 */
require_once(__DIR__ . '/../php/comprobarAcceso.php');
require_once(__DIR__ . '/../php/funciones.php');

$title = 'Mis Mensajes';
$esRegistrado = true;

require_once(__DIR__ . '/../php/cabecera.php');
require_once(__DIR__ . '/../php/inicio.php');
?>

    <main id="contenido-principal">
        <header>
            <div>
                <h2><i class="fa-solid fa-envelope" role="img" aria-label="Mensajes"></i> Centro de Mensajes de <?= e($usuarioActual); ?></h2>
                <p>Historial de comunicaciones recibidas y enviadas a través del portal inmobiliario.</p>
            </div>
            <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-user" role="img" aria-label="Perfil"></i> Mi perfil</a>
        </header>

        <section>
            <h3><i class="fa-solid fa-inbox" role="img" aria-label="Recibidos"></i> Mensajes Recibidos</h3>
            <table style="width: 100%;">
                <caption>Buzón de entrada de comunicaciones</caption>
                <thead>
                    <tr>
                        <th scope="col">Remitente</th>
                        <th scope="col">Anuncio de referencia</th>
                        <th scope="col">Tipo de mensaje</th>
                        <th scope="col">Contenido del mensaje</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Carlos Ruiz</strong></td>
                        <td>Casa moderna con jardín</td>
                        <td>Solicitar cita</td>
                        <td>¿Sería posible concertar una visita este fin de semana? Muchas gracias.</td>
                        <td>04/11/2026</td>
                    </tr>
                    <tr>
                        <td><strong>Marta Gómez</strong></td>
                        <td>Chalet junto al mar</td>
                        <td>Más información</td>
                        <td>Hola, me gustaría saber si la vivienda dispone de plaza de garaje incluida.</td>
                        <td>03/11/2026</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section>
            <h3><i class="fa-solid fa-paper-plane" role="img" aria-label="Enviados"></i> Mensajes Enviados</h3>
            <table style="width: 100%;">
                <caption>Registro de comunicaciones remitidas</caption>
                <thead>
                    <tr>
                        <th scope="col">Destinatario</th>
                        <th scope="col">Anuncio de referencia</th>
                        <th scope="col">Tipo de comunicación</th>
                        <th scope="col">Mensaje enviado</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Antonio Carbonell</strong></td>
                        <td>Casa moderna con jardín</td>
                        <td>Oferta económica</td>
                        <td>Buenos días, estoy muy interesado en el inmueble y me gustaría presentar una propuesta.</td>
                        <td>02/11/2026</td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="menuUsuario.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-arrow-left" role="img" aria-label="Volver"></i> Volver a mi perfil</a>
                <a href="misAnuncios.php?usuario=<?= urlencode($usuarioActual); ?>" class="conBorde"><i class="fa-solid fa-list-check" role="img" aria-label="Anuncios"></i> Ver mis anuncios</a>
            </div>
        </section>
    </main>

<?php
require_once(__DIR__ . '/../php/pie.php');
?>
