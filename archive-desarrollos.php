<?php get_header(); ?>

    <section>

        <div class="position-relative mb-5" style="height:60vh;">
            <video class="w-100 h-100" style="object-fit:cover;" src="<?= get_template_directory_uri() ?>/assets/videos/riviera-maya-bg.mp4" muted autoplay loop poster="<?= get_template_directory_uri() ?>/assets/images/poster-riviera-maya.webp"></video>

            <div class="fondo-azul"></div>

            <div class="row justify-content-center position-absolute top-0 start-0 h-100 z-3">
                <div class="col-12 text-center text-white align-self-center">
                    <img class="col-10 col-lg-4 mb-3" src="<?= get_template_directory_uri() ?>/assets/images/logo-riviera-maya.webp" alt="Logo de la Riviera Maya">
                    <h1 class="fw-light fs-1 px-5 px-lg-0"><?php pll_e('Descubre los mejores desarrollos de la Riviera Maya') ?></h1>
                </div>
            </div>

        </div>

        <div class="container fs-5 fw-light mb-5">
            <p><?php pll_e('Trabajamos con los mejores desarrolladores para ofrecerte excelentes oportunidades de vivienda o inversión ubicados en un increible lugar como la Riviera Maya.') ?></p>
            <p class="mb-5 mb-lg-0"><?php pll_e('Vemos por un crecimiento integral y trascendente, cuyo soporte es el amor a la vida y el servicio. Tenemos como prioridad satisfacer las necesidades y deseos de nuestros clientes.') ?></p>
            <hr class="hr-red">
        </div>

        <?php if ( have_posts() ): ?>
        
            <div class="container row justify-content-center mb-6">

                <?php while( have_posts() ): the_post();?>

                    <?php $images = rwmb_meta('gallery', ['limit' =>1 , 'size' => 'medium_large' ] ) ?>

                    <div class="col-12 col-lg-6">
                        <a href="<?= get_the_permalink() ?>" class="card text-decoration-none text-blue rounded-0 shadow-4">
                            <img src="<?= $images[0]['url'] ?>" class="w-100" alt="<?= get_the_title() ?>" style="height:370px; object-fit:cover;">
                            <div class="p-4">
                                <h2 class="card-title fw-normal"><?= get_the_title() ?></h2>
                                <p class="card-text fw-light fs-5 mb-1">
                                    <i class="fa-solid fa-location-dot"></i> <?php get_list_terms(get_the_ID(), 'regiones') ?>
                                </p>
                                <p class="fs-4 mb-1"><?php pll_e('Precios desde') ?>: $<?= number_format(rwmb_meta('price')) ?> <?= rwmb_meta('currency') ?></p>
                            </div>
                        </a>
                    </div>

                <?php endwhile; ?>

                <?php the_posts_pagination( array(
                    'prev_text' => '<<',
                    'next_text' => '>>',
                ) ); ?>
                
            </div>
            
        <?php endif; ?>

    </section>

<?php get_footer(); ?>