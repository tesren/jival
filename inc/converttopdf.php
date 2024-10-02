<?php
// Incluir la biblioteca de Dompdf
require '../vendor/autoload.php';

use Dompdf\Dompdf;

if (isset($_POST['sendpdf'])) {
    $titulo = $_POST['titulo'];
    $desc = $_POST['descripcion'];
    $address = $_POST['region'];
    $precio = $_POST['precio'];
    $currency = $_POST['currency'];
    $bedrooms = $_POST['bedrooms'];
    $baths = $_POST['bathrooms'];
    $half_baths = $_POST['half_baths'];
    $const = $_POST['const'];
    $lote = $_POST['lote'];
    $prop_type = $_POST['prop_type'];
    $amenities = $_POST['amenities'];

    $imagenSrc = $_POST['imagen'];
    $imagenSrc2 = $_POST['imagen2'];
    $imagenSrc3 = $_POST['imagen3'];
    $imagenSrc4 = $_POST['imagen4'];
    $imagenSrc5 = $_POST['imagen5'];
    $imagenSrc6 = $_POST['imagen6'];
    $imagenSrc7 = $_POST['imagen7'];
    $imagenSrc8 = $_POST['imagen8'];

    $link = $_POST['permalink'];
    $directory = $_POST['directory'];

    $api_key = 'AIzaSyDlDmMESUjBK1gwNJm5x4hyoS90qacpJmY';
    $direccion = urlencode($address);
    $zoom = 15;
    $tamano = '600x300';
    $maptype = 'roadmap';
    
    // Añade el marcador en la dirección especificada
    $marker = "markers=color:red%7Clabel:o%7C$direccion";
    
    // Genera la URL del mapa estático con el marcador
    $mapa_url = "https://maps.googleapis.com/maps/api/staticmap?center=$direccion&zoom=$zoom&size=$tamano&maptype=$maptype&$marker&key=$api_key";

    // Crear una instancia de Dompdf
    $dompdf = new Dompdf(array('enable_remote' => true));

    // Generar el contenido HTML dinámicamente (puedes usar variables PHP)
    ob_start();
    ?>
    <html>
    <head>
        <title><?= $titulo ?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .header, .footer {
                text-align: center;
            }
            .content {
                margin: 20px;
            }
            .image {
                width: 100%;
                height: auto;
                object-fit:cover;
            }
            table{
                width: 100%;
            }
            th{
                text-align:left;
            }
            td{
                padding-bottom:0.5rem;
            }
        </style>
    </head>
    <body>


        <!-- Nombre y Precio  -->
        <table style="margin-bottom:20px;">
            <tbody>
                <tr style="margin-bottom:25px;">
                    <td style="width:70%;">
                        <h1 style="font-size:24px;"><?= $titulo ?></h1>
                        <h2 style="font-size:14px; color:gray;"><?= $address ?></h2>
                    </td>
                    <td style="width:30%; text-align:end;">

                        <?php if( $prop_type == 'rent' ): ?>
                            <strong>$<?= number_format($precio) ?> MXN / noche</strong> <small>EN RENTA</small>
                        <?php else: ?>
                            <strong>$<?= number_format($precio) ?> <?= $currency ?></strong> <small>EN VENTA</small>
                        <?php endif; ?>

                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Imagenes -->
        <table>
            <tbody>
                <tr>
                    <!-- Primer imagen -->
                    <td style="width:63%;">
                        <img class="image" src="<?= $imagenSrc ?>" alt="">
                    </td>

                    <!-- Otra imagen y ubicacion -->
                    <td style="width:37%;">
                        <img class="image" src="<?= $imagenSrc2 ?>" alt="">
                        <img class="image" src="<?= $mapa_url; ?>" alt="Mapa de Google">
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Datos -->
        <table>

            <tbody>

                <tr>

                    <td style="text-align:center;">
                        <?= $bedrooms ?>
                        <div style="color:gray; font-size:12px;">Recámaras</div>
                    </td>

                    <td style="text-align:center;">
                        <?= $baths ?>
                        <div style="color:gray; font-size:12px;">Baños</div>
                    </td>

                    <?php if( !empty($half_baths) ): ?>
                        <td style="text-align:center;">
                            <?= $half_baths ?>
                            <div style="color:gray; font-size:12px;">Medios Baños</div>
                        </td>
                    <?php endif; ?>


                    <?php if( !empty($const) ): ?>
                        <td style="text-align:center;">
                            <?= $const ?> m²
                            <div style="color:gray; font-size:12px;">Construcción</div>
                        </td>
                    <?php endif; ?>


                    <?php if( !empty($lote) ): ?>
                        <td style="text-align:center;">
                            <?= $lote ?> m²
                            <div style="color:gray; font-size:12px;">Terreno</div>
                        </td>
                    <?php endif; ?>

                </tr>

            </tbody>
            
        </table>
        

        <table>
            <tbody>
                
                <tr>
                    <!-- Datos -->
                    <td style="width:70%;">
                        <table class="table">

                            <tbody>

                                <tr>
                                    <td colspan="2">
                                        <div style="font-weight:bold; margin-bottom:5px;">Descripción</div>
                                        <p><?= $desc ?></p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;">Fecha de impresión:</td>
                                    <td><?= date('d-m-Y') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                    <!-- Amenidades -->
                    <td style="width:30%;">
                    
                        <div style="font-weight:bold;">Amenidades</div>
                        <div><?= $amenities ?></div>

                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <img src="https://test.jival.com/wp-content/uploads/2024/07/jival-logo.jpg" alt="Logo"  style="width:50%; margin:15px 0px;">
            <p>Para más información, visita: <a href="<?= $link ?>"><?= $link ?></a></p>
        </div>

        <!-- Más imágenes -->
        <table>
            <tbody>
                <tr>
                    <td style="width:50%;">
                        <img class="image" src="<?= $imagenSrc3 ?>" alt="">
                    </td>
                    <td style="width:50%;">
                        <img class="image" src="<?= $imagenSrc4 ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="width:50%;">
                        <img class="image" src="<?= $imagenSrc5 ?>" alt="">
                    </td>
                    <td style="width:50%;">
                        <img class="image" src="<?= $imagenSrc6 ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="width:50%;">
                        <img class="image" src="<?= $imagenSrc7 ?>" alt="">
                    </td>
                    <td style="width:50%;">
                        <img class="image" src="<?= $imagenSrc8 ?>" alt="">
                    </td>
                </tr>
            </tbody>
        </table>

    </body>
    </html>
    <?php
    $html = ob_get_clean();

    // Cargar el HTML en Dompdf
    $dompdf->loadHtml($html);

    // (Opcional) Configurar opciones de Dompdf
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el HTML como PDF
    $dompdf->render();

    // Enviar el PDF generado al navegador
    $dompdf->stream("documento.pdf", array("Attachment" => false));
} else {
    echo "No se han recibido datos para generar el PDF.";
}
?>