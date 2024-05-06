<?php
    /*
    Template Name: Sell Template
    */

    get_header();

    $agents = get_posts(array(
        'post_type' => 'agentes',
        'numberposts' => -1,
    ));

?>

<!-- Inicio -->
<div class="row mb-6 bg-red">

    <div class="col-12 col-lg-4 align-self-center p-3 p-lg-5 text-center">

        <h1 class="fs-0 fw-normal"><?php pll_e('¿Quieres vender una propiedad?') ?></h1>

    </div>

    <div class="col-12 col-lg-8 p-4 p-lg-5 text-center text-lg-start" style="background-image: url('<?= get_template_directory_uri().'/assets/images/wavy-bg.webp' ?>');background-repeat: no-repeat; background-size: cover;">
        <h2 class="fw-light"><?php pll_e('Confía tu patrimonio en nosotros y vive plenamente tranquilo.') ?></h2>
        <a href="#contact" class="btn btn-outline-light rounded-0 fs-4 fw-light px-5"><?php pll_e('Contáctanos') ?></a>
    </div>

</div>

<!-- 25 años de xp -->
<div class="row justify-content-center mb-5">

    <div class="col-12 col-lg-3 fs-1 fw-semibold text-center text-lg-start mb-5 mb-lg-0">
        <div style="line-height:1;">
            <span style="font-size:100px;">25</span> <span class="text-red"><?php pll_e('años') ?></span>
        </div>
        <div><?php pll_e('de experiencia') ?></div>
    </div>

    <div class="col-12 col-lg-7 p-3 p-lg-5">
        <h3 class="fw-normal"><?php pll_e('¿Quiénes somos?') ?></h3>
        <p class="fs-5 fw-light"><?php pll_e('Somos una inmobiliaria con 25 años de experiencia que te orientará y acompañará en todo el proceso de la compra, venta y/o renta de tu bien inmueble, para que puedas obtener el mayor provecho en términos de tiempo y dinero.') ?></p>
    </div>

</div>

<div class="row justify-content-center mb-6 bg-light py-5">

    <div class="col-12 col-lg-7">
        <h3 class="fw-normal"><?php pll_e('Contamos con todos los recursos para lograr dicho objetivo') ?></h3>
        <ul class="fs-5 fw-light">
            <li><?php pll_e('Nuestros agentes estan altamente calificados en el tema inmobiliario.') ?></li>
            <li><?php pll_e('Empatizamos con nuestros clientes para brindarles un servicio personalizado.') ?></li>
            <li><?php pll_e('Brindamos asesoría legal y fiscal.') ?></li>
        </ul>
    </div>

    <div class="col-12 col-lg-3 align-self-center text-center">
        <i class="fa-solid fa-5x text-red fa-user-group"></i>
    </div>

</div>

<img src="<?= get_template_directory_uri() ?>/assets/images/sell-jival.webp" alt="Vende tu propiedad con Jival Bienes Raíces" class="w-100 mb-6" style="max-height:60vh; object-fit:cover;">

<div class="container text-center fs-5 mb-6 fw-light">
    <p><?php pll_e('Contamos con un equipo integral de profesionales reacionados directamente con el medio, Broker hipotecário, valuadores, notarías, arquitectos, topógrafo, abogado, contador, fiscalista y más.') ?></p>
    <i class="fa-solid text-red fa-circle"></i>
    <p><?php pll_e('Promocionamos las propiedades en los mejores portales inmobiliarios. Colaboramos con otras inmobiliarias para lograr mayor rapidez en las ventas.') ?></p>
</div>

<div class="container row mb-6">

    <h4 class="text-center fs-2 mb-4 mb-lg-5"><?php pll_e('Conoce a nuestro equipo') ?></h4>

    <?php foreach($agents as $agent): ?>
        <div class="col-12 col-lg-4">

            <div class="card mb-3 shadow-4 bg-light rounded-3">
                <div class="row g-0">

                    <div class="col-4 text-center align-self-center">
                        <?php if($agent->agent_position == 'Socio Director'): ?>
                            <i class="fa-solid text-red fa-4x fa-suitcase"></i>
                        <?php elseif($agent->agent_position == 'Asesor de Ventas'): ?>
                            <i class="fa-solid text-red fa-4x fa-user-tie"></i>
                        <?php else: ?>
                            <i class="fa-solid text-red fa-4x fa-clipboard-list"></i>
                        <?php endif; ?>
                    </div>

                    <div class="col-8">
                        <div class="card-body text-blue">

                            <h5 class="card-title mb-1 fs-4"><?= get_the_title($agent->ID) ?></h5>
                            <p class="card-text mb-1 fw-light fs-5"><?= $agent->agent_position ?></p>
                            <a href="mailto:ma.inesvalencia@gmail.com" class="text-blue fw-light fs-6"><?= $agent->agent_email ?></a>

                            <?php if( isset($agent->agent_phone) ): ?>
                                <a href="tel:+52<?= $agent->agent_phone ?>" class="text-blue fw-light fs-6 d-block"><i class="fa-solid fa-phone"></i> <?= $agent->agent_phone ?></a>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    <?php endforeach; ?>

</div>



<!-- Formulario de contacto -->
<?php echo  get_template_part( 'partials/content', 'contact-form' ); ?>

<?php get_footer(); ?>