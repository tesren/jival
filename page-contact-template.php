<?php
    /*
    Template Name: Contact Template
    */
    get_header();
?>

<!-- Inicio -->
<div class="row mb-6 bg-red">

    <div class="col-12 col-lg-4 align-self-center p-3 p-lg-5 text-center text-lg-end">

        <a href="https://www.facebook.com/JivalBR" target="_blank" rel="noopener noreferrer" class="link-light text-decoration-none me-3 me-lg-4">
            <i class="fa-brands fs-0 fa-facebook"></i>
        </a>

        <a href="https://www.youtube.com/@JivalBR/featured" target="_blank" rel="noopener noreferrer" class="link-light text-decoration-none">
            <i class="fa-brands fs-0 fa-youtube"></i>
        </a>

    </div>

    <div class="col-12 col-lg-8 p-4 p-lg-5 text-center text-lg-start" style="background-image: url('<?= get_template_directory_uri().'/assets/images/wavy-bg.webp' ?>');background-repeat: no-repeat; background-size: cover;">
        <h1 class="fw-light"><?php pll_e('Ponte en contacto con nosotros para brindarte las mejores soluciones del mercado.') ?></h1>
    </div>

</div>

<div class="bg-light row justify-content-center mb-6 py-5">

    <div class="col-12 col-lg-7 col-xxl-5">
        <h2 class="fs-2 text-center mb-3"><?php pll_e('Escríbenos') ?></h2>

        <?= do_shortcode( '[contact-form-7 id="1ba88c6" title="Formulario de contacto 1"]' ) ?>
    </div>

</div>

<!-- Ubicación -->
<div class="row bg-light">

    <div class="col-4 bg-blue py-1"></div>
    <div class="col-8 bg-red py-1"></div>

    <div class="col-12 col-lg-4 align-self-center text-center py-5 py-lg-0">
        <i class="fa-solid fa-3x fa-map-location-dot mb-3"></i>
        <address class="px-1 px-lg-5 fs-5 fw-light">Bosques de La Cascada 6 Locales: E13 y E14 Las Cañadas, 45206 Zapopan, Jal.</address>
    </div>

    <div class="col-12 col-lg-8 px-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7650.908726130793!2d-103.38112405203618!3d20.77594189456329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428a546cd713a91%3A0x54999413bb7fdf4a!2sJIVAL%20BIENES%20RAICES%20S.A.%20DE%20C.V.!5e0!3m2!1ses-419!2smx!4v1715025471013!5m2!1ses-419!2smx" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>


<?php get_footer(); ?>