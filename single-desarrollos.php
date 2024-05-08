<?php
    get_header(); 
    $images = rwmb_meta('gallery',array('size'=>'full', 'limit'=>2));
    $imagesLarge = rwmb_meta('gallery',array('size'=>'large', 'limit'=>30));
    $models = get_posts(array(
        'post_type' => 'inventory',
        'meta_query' => array(
            array(
                'key' => 'desarrollo', // name of custom field
                'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
                'compare' => 'LIKE'
            )
        )
    ));
 ?>


<?php if( have_posts() ):?>

    <?php while( have_posts() ) : the_post(); ?>

        <?php $images = rwmb_meta('gallery', ['size'=>'large', 'limit'=>40]);?>

        <!-- Imagenes -->
        <div class="row justify-content-cente mb-4 position-relative">

            <a href="#gallery-1" class="btn btn-light ms-3 ms-lg-5 mb-3 mb-lg-5 position-absolute start-0 bottom-0 col-4 col-lg-1">
                <i class="fa-solid fa-image"></i> <?php pll_e('Ver galería') ?>
            </a>

            <div class="col-12 col-lg-6 p-1">
                <img src="<?= $images[0]['url'] ?>" alt="Galería de <?= get_the_title() ?>" data-fancybox="gallery" class="w-100 single-main-img">
            </div>

            <div class="col-12 col-lg-6 p-0">
                <div class="row justify-content-center">
                    <div class="col-6 p-0">
                        <img src="<?= $images[1]['url'] ?>" alt="Galería de <?= get_the_title() ?>" data-fancybox="gallery" class="w-100 p-1 single-secondary-img">
                        <img src="<?= $images[3]['url'] ?>" alt="Galería de <?= get_the_title() ?>" data-fancybox="gallery" class="w-100 p-1 d-none d-lg-block single-secondary-img">
                    </div>
                    <div class="col-6 p-0">
                        <img src="<?= $images[2]['url'] ?>" alt="Galería de <?= get_the_title() ?>" data-fancybox="gallery" class="w-100 p-1 single-secondary-img">
                        <img src="<?= $images[4]['url'] ?>" alt="Galería de <?= get_the_title() ?>" data-fancybox="gallery" class="w-100 p-1 d-none d-lg-block single-secondary-img">
                    </div>
                </div>
            </div>

        </div>

        <?php 
            if( count($images) > 5 ):
                for($i=5; $i<count($images); $i++ ): 
            ?>
            <img src="<?= $images[$i]['url'] ?>" alt="Galería de <?= get_the_title() ?>" data-fancybox="gallery" class="d-none">
            <?php 
                endfor; 
            endif;
        ?>

        <!-- Descripcion -->
        <div class="row justify-content-evenly mb-6">

            <div class="col-11 col-lg-7 border-start border-danger mb-4 mb-lg-0">
                <?= get_property_type(get_the_ID(), 'property_type') ?> <?php pll_e('en venta') ?>
                <h1 class="fw-normal"><?= get_the_title() ?></h1>

                <p class="fw-light"><?= get_the_content() ?></p>
            </div>

            <div class="col-12 col-lg-3 text-center align-self-center">
                <div><?php pll_e('Precios desde') ?></div>
                <div class="fs-2 mb-2">$<?= number_format(rwmb_meta('price')) ?> <?= rwmb_meta('currency') ?></div>
                <a href="#contact" class="btn btn-blue"><?php pll_e('Contacta un asesor') ?></a>
            </div>

        </div>

        <!-- Amenidades -->
        <?php 
            $amenities = rwmb_meta('amenities');
        ?>

        <?php if($amenities): ?>
        <div class="row justify-content-center py-5 bg-light">
            <h2 class="text-center col-12 mb-5"><?php pll_e('Amenidades');?></h2>

            <div class="col-12 col-lg-10 col-xxl-8 row justify-content-center">
                <?php foreach($amenities as $amt):?>

                    <div class="col text-center mb-3">
                        <img style="height:60px;" src="<?= get_template_directory_uri().'/assets/images/amenities/'.$amt.'.svg' ?>" alt="<?= $amt; ?>">
                        <p class="fs-5 mt-2 fw-light"><?php pll_e($amt) ?></p>
                    </div>
                            
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Ubicación -->
        <div class="row bg-light mb-6">

            <div class="col-4 bg-blue py-1"></div>
            <div class="col-8 bg-red py-1"></div>

            <div class="col-12 col-lg-4 align-self-center text-center py-5 py-lg-0">
                <i class="fa-solid fa-3x fa-map-location-dot mb-3"></i>
                <address class="px-1 px-lg-5 fs-5 fw-light"><?= rwmb_meta('address') ?></address>
            </div>

            <div class="col-12 col-lg-8">
            <?php
                $args = [
                    'width'        => '100%',
                    'height'       => '480px',
                    'zoom'         => 15,
                    'marker'       => true,
                    'marker_title' => get_the_title(),
                ];
                rwmb_the_value( 'development_map', $args );
            ?>
            </div>

        </div>

        <!-- Unidad modelo -->
        <div class="row justify-content-center justify-content-lg-between mb-6">

            <div class="col-12 col-lg-7 text-center">
                <h3><?php pll_e('Conoce nuestra unidad modelo') ?></h3>
                <p class="fs-5 fw-light ps-0 ps-lg-5"><?= rwmb_meta('model_desc') ?></p>

                <a href="#contact" class="btn btn-outline-danger rounded-0">
                    <?php pll_e('Contactar') ?>
                </a>
            </div>

            <div class="col-12 col-lg-3 ps-0 bg-red align-self-center py-5 d-none d-lg-block"></div>

            <?php $model_imgs = rwmb_meta('model_gallery', ['size'=>'medium_large'] ); ?>

            <div class="col-12 mt-5">
                <section class="splide" id="model_gallery">

                    <div class="splide__track py-3">
                        <ul class="splide__list">

                            <?php foreach($model_imgs as $img): ?>

                                <li class="splide__slide px-1">
                                    <img src="<?= $img['url'] ?>" alt="Unidad Model de <?php get_the_title() ?> - Jival Bienes Raíces" class="w-100">
                                </li>

                            <?php endforeach; ?>

                        </ul>
                    </div>

                </section>
            </div>

        </div>

        <!-- Formulario de contacto -->
        <?php echo  get_template_part( 'partials/content', 'contact-form' ); ?>

    <?php endwhile;?>

<?php endif;?>


<?php get_footer(); ?>