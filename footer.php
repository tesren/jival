
<footer class="bg-blue pt-4 pt-lg-5">

    <div class="row justify-content-evenly px-2">

        <div class="col-11 col-lg-2 mb-5 mb-lg-0 align-self-center">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/jival-white-logo.webp" alt="Logo de Jival Bienes Raíces" class="w-100">

            <div class="text-center fs-5 my-2">
                <a href="https://www.facebook.com/JivalBR" target="_blank" rel="noopener noreferrer" class="link-light text-decoration-none me-3">
                    <i class="fa-brands fa-facebook"></i>
                </a>

                <a href="https://www.youtube.com/@JivalBR/featured" target="_blank" rel="noopener noreferrer" class="link-light text-decoration-none">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </div>
            
        </div>

        <div class="col-12 col-lg-3 mb-5 mb-lg-0 text-center text-lg-start">
            <h6 class="fs-4"><?php pll_e('Contacto')?></h6>
            <a href="mailto:informesjival@gmail.com" class="link-light text-decoration-none fs-5 d-block mb-2 fw-light">
                <i class="fa-regular fa-envelope"></i>
                informesjival@gmail.com
            </a>
            
            <a href="tel:+523336850524" class="link-light text-decoration-none fs-5 d-block fw-light">
                <i class="fa-solid fa-phone"></i>
                (01)(33) 3685-0524
            </a>

            <a href="tel:+523336850334" class="link-light text-decoration-none fs-5 d-block fw-light">
                <i class="fa-solid fa-phone"></i>
                (01)(33) 3685-0334
            </a>

        </div>

        <div class="col-12 col-lg-3 text-center text-lg-start">
            <h6 class="fs-4"><?php pll_e('Domicilio')?></h6>
            <address class="fw-light fs-5">
                <i class="fa-solid fa-location-dot"></i> <a href="https://maps.app.goo.gl/rqynXaCJgLKphkM37" class="link-light text-decoration-none">Centro Comercial Las Cañadas Local B1-A y B1-B, Zapopan, Jalisco, 45206</a>
            </address>
        </div>

        <div class="col-12 text-center mt-4 mb-3">
            <a href="https://punto401.com" class="d-block link-light text-decoration-none">
                Powered by <img width="70px" src="<?= get_template_directory_uri() ?>/assets/images/logo-p401.webp" alt="Logo de Punto401 Marketing">
            </a>
        </div>

    </div>

    <div class="py-1 text-center d-flex justify-content-center bg-light">
        <div class="text-blue">
            Jival Bienes Raíces
            <i class="fa-regular fa-copyright"></i>
            2016 - <?php echo date('Y');?>
        </div>
        <a href="#" class="d-block text-blue ms-3"><?php pll_e('Políticas de Privacidad')?></a>
    </div>

</footer>


<script src="<?php echo get_template_directory_uri()?>/assets/js/bootstrap.bundle.min.js" defer></script>
<script src="<?php echo get_template_directory_uri()?>/assets/js/splide.min.js" defer></script>
<script src="<?php echo get_template_directory_uri()?>/assets/js/fancybox.umd.js" defer></script>
<script src="<?php echo get_template_directory_uri()?>/assets/js/jival_main.js" defer></script>

<?php wp_footer(); ?>
</body>
</html>             