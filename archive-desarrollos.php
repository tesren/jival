<?php get_header(); ?>

    <section>

        <?php if ( have_posts() ): ?>

            <div class="position-relative mb-5" style="height:60vh;">
                <video class="w-100 h-100" style="object-fit:cover;" src="<?= get_template_directory_uri() ?>/assets/videos/riviera-maya-bg.mp4" muted autoplay loop></video>

                <div class="fondo-oscuro"></div>

                <div class="row justify-content-center position-absolute top-0 start-0 h-100 z-3">
                    <div class="col-12 text-center text-white align-self-center">

                    </div>
                </div>

            </div>

            <div class="container fs-5 fw-light">
                <p><?php pll_e('Trabajamos con los mejores desarrolladores para ofrecerte excelentes oportunidades de vivienda o inversión ubicados en un increible lugar como la Riviera Maya.') ?></p>
                <p><?php pll_e('Vemos por un crecimiento integral y trascendente, cuyo soporte es el amor a la vida y el servicio. Tenemos como prioridad satisfacer las necesidades y deseos de nuestros clientes.') ?></p>
            </div>

            <div class="container row justify-content-center mb-6 position-relative">

                <img width="250px" src="<?php echo get_template_directory_uri();?>/assets/icons/half-circle-gold.webp" alt="" class="position-absolute top-0 end-0 z-1 px-0" style="transform: rotate(180deg); width:250px;" loading="lazy">
                <img width="250px" src="<?php echo get_template_directory_uri();?>/assets/icons/half-circle-gold.webp" alt="" class="position-absolute top-50 start-0 z-1 px-0" style="width:250px;" loading="lazy">

                <?php while( have_posts() ): the_post();?>

                   

                <?php endwhile; ?>

            </div>
            
        <?php endif; ?>

    </section>

<?php get_footer(); ?>