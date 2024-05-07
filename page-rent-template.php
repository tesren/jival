<?php
    /*
    Template Name: Rent Management Template
    */
    get_header();
?>

<!-- Inicio -->
<div class="row justify-content-center mb-6 py-5" style="background-image: url('<?= get_template_directory_uri().'/assets/images/wavy-bg.webp' ?>');background-repeat: no-repeat; background-size: cover;">

    <div class="col-12 col-lg-8 px-3 px-lg-5 text-center text-lg-start mb-3 mb-lg-0">
        <h1 class="fw-light text-white"><?php pll_e('En Jival cuidamos de tu patrimonio, deja en nuestras manos administrar tu propiedad') ?></h1>
    </div>

    <div class="col-10 col-lg-3 align-self-center">
        <a href="#contact" class="btn btn-outline-light w-100 rounded-0">
            <?php pll_e('Contáctanos') ?>
        </a>
    </div>

</div>

<!-- Servicios -->
<div class="row justify-content-evenly mb-0 mb-lg-5">

    <div class="col-12 col-lg-4 mb-4 mb-lg-0">
        <img src="<?= get_template_directory_uri() ?>/assets/images/admin-rent-jival.webp" alt="Administración de rentas en Jival Bienes Raíces" class="w-100">
    </div>

    <div class="col-12 col-lg-5 align-self-center">
        <h2><?php pll_e('Te brindamos los mejores servicios') ?></h2>
        <ul>
            <li><?php pll_e('Publicamos las propiedades en los mejores portales inmobiliarios, redes sociales y más.') ?></li>
            <li><?php pll_e('Investigamos a los inquilinos, a sus fiadores y elaboramos contratos.') ?></li>
            <li><?php pll_e('Entregamos la propiedad previo a revisar sus condiciones físicas y respaldando lo anterior con fotografías.') ?></li>
            <li><?php pll_e('Estamos al pendiente del pago oportuno de la renta.') ?></li>
            <li><?php pll_e('Nos mantenemos atentos a problemas de mantenimiento y reparaciones que puedan surgir en el transcurso del arrendamiento para darles solución y gestionar su pago y cobro según la parte responsable. Contamos con un equipo externo de apoyo de primera, tales como: Fontaneros, electricistas, carpinteros, pintores, albañiles, entre otros.') ?></li>
        </ul>
    </div>

</div>

<div class="row justify-content-evenly mb-6">
    <div class="col-12 col-lg-5 align-self-center order-2 order-lg-1">
        <ul>
            <li><?php pll_e('Hacemos la renovación del contrato cuando la vigencia del mismo termine y verificamos el estado físico de la propiedad informándole al propietario.') ?></li>
            <li><?php pll_e('Recibimos la propiedad cuando el inquilino la entregue verificando el estado físico de la misma, así como, los pagos de los servicios al corriente, y en su momento si procede a la devolución del depósito.') ?></li>
            <li><?php pll_e('En todo momento mantenemos comunicación abierta en horario de atención a clientes tanto como del propietario como el inquilino.') ?></li>
            <li><?php pll_e('Brindamos asesoría legal gratuita al proipietario que lo requiera sin que ello implique un juicio.') ?></li>
            <li><?php pll_e('Cobramos un 10% de honorarios del mes total de renta.') ?></li>
        </ul>
    </div>

    <div class="col-12 col-lg-4 order-1 order-lg-2 mb-3 mb-lg-0">
        <img src="<?= get_template_directory_uri() ?>/assets/images/admin-rent.webp" alt="Administración de rentas en Jival Bienes Raíces" class="w-100">
    </div>
</div>

<!-- Formulario de contacto -->
<?php echo  get_template_part( 'partials/content', 'contact-form' ); ?>

<?php get_footer(); ?>