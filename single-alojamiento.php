<?php 
    get_header();

    $more_rentals = get_posts(array(
        'post_type' => 'alojamiento',
        'numberposts' => 3,
        'orderby' => 'rand',
        'exclude' => get_the_ID(),
    ));
?>

    <article>
  
        <?php if ( have_posts() ): ?>
                
            <?php while( have_posts() ): the_post();?>

                <?php $images = rwmb_meta('listing_gallery', ['size'=>'large', 'limit'=>40]);?>

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
                        <div class="fs-2 mb-2">$<?= number_format(rwmb_meta('price')) ?> <?= rwmb_meta('currency') ?> MXN <small class="fw-light"><?php pll_e('Por noche') ?></small></div>
                        <a href="#contact" class="btn btn-blue"><?php pll_e('Contacta un asesor') ?></a>
                    </div>

                </div>

                <!-- Características -->
                <div class="bg-light px-1 px-lg-5 py-5">
                    <h2 class="mb-4 text-center text-lg-start"><?php pll_e('Características, servicios y amenidades') ?></h2>

                    <div class="row justify-content-evenly">

                        <div class="col-11 col-lg-4 border-start border-danger mb-4 mb-lg-0 align-self-start">
                            <ul class="list-unstyled fs-4 fw-light">
                                <?php if(rwmb_meta('bedrooms')): ?>
                                    <li>
                                        <i class="fa-solid text-red fa-bed"></i> <?= rwmb_meta('bedrooms') ?> <?php pll_e('recámaras') ?>
                                    </li>
                                <?php endif; ?>

                                <?php if(rwmb_meta('bathrooms')): ?>
                                    <li>
                                        <i class="fa-solid text-red fa-bath"></i> <?= rwmb_meta('bathrooms') ?> <?php pll_e('baños') ?>
                                    </li>
                                <?php endif; ?>

                                <?php if(rwmb_meta('parking')): ?>
                                    <li>
                                        <i class="fa-solid text-red fa-car"></i> <?= rwmb_meta('parking') ?>
                                    </li>
                                <?php endif; ?>

                                <?php if(rwmb_meta('guests')): ?>
                                    <li>
                                        <i class="fa-solid text-red fa-person"></i> <?= rwmb_meta('guests') ?> <?php pll_e('huéspedes') ?>
                                    </li>
                                <?php endif; ?>


                            </ul>
                        </div>

                        <div class="col-11 col-lg-7">
                            <ul class="fs-4 fw-light">
                                <?php $amenities = rwmb_meta('amenities') ?>

                                <?php foreach($amenities as $amt): ?>
                                    <li><?= $amt ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>

                </div>

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
                        rwmb_the_value( 'map', $args );
                    ?>
                    </div>

                </div>

                <!-- Propiedades "similares" -->
                <?php if( count($more_rentals) > 0): ?>
                    <div class="container row justify-content-center mb-6">
                        <h3 class="col-12 text-center mb-5 fs-2 fw-normal"><?= pll_e('Más propiedades en renta') ?></h3>

                        <?php foreach($more_rentals as $listing): ?>
                            <?php
                                    $listing_gallery = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1], $listing->ID);
                                    $property_type = get_property_type($listing->ID, 'rental-type');

                                    switch($property_type){

                                        case 'Casa':
                                            $prop_icon = '<i class="fa-solid fa-house-chimney"></i>';
                                        break;

                                        case 'Departamento':
                                            $prop_icon = '<i class="fa-solid fa-building"></i>';
                                        break;

                                        case 'Lote':
                                            $prop_icon = '<i class="fa-solid fa-building"></i>';
                                        break;

                                        default:
                                            $prop_icon = '<i class="fa-solid fa-house-chimney"></i>';
                                        break;
                                    }
                                ?>

                            <div class="col-12 col-lg-4">
                                <a href="<?= get_the_permalink( $listing->ID ) ?>" class="card rounded-0 text-decoration-none border-0 text-center shadow-4">
        
                                    <div class="position-relative">
                                        <div class="position-absolute start-50 top-0 bg-light text-blue z-3 px-2 py-1 rounded-2" style="transform:translate(-50%, -50%);">
                                            <?= $prop_icon ?> <?= $property_type ?>
                                        </div>
        
                                        <img src="<?= $listing_gallery[0]['url'] ?>" class="w-100" alt="<?= get_the_title($listing->ID) ?>" style="height:350px; object-fit:cover;">
        
                                    </div>
        
                                    <div class="bg-blue card-title mt-2 py-1 fw-light"><?= get_the_title( $listing->ID ) ?></div>
        
                                    <div class="card-body pt-2">
        
                                        <div class="d-flex justify-content-center">
        
                                            <?php if( isset($listing->bedrooms) ): ?>
                                                <div class="fs-4 text-blue fw-light me-3">
                                                    <i class="fa-solid fa-bed text-red"></i> <?= $listing->bedrooms ?>
                                                </div>
                                            <?php endif; ?>
        
                                            <?php if( isset($listing->bathrooms) ): ?>
                                                <div class="fs-4 text-blue fw-light me-3">
                                                    <i class="fa-solid fa-bath text-red"></i> <?= $listing->bathrooms ?>
                                                </div>
                                            <?php endif; ?>
        
                                            <?php if( isset($listing->guests) ): ?>
                                                <div class="fs-4 text-blue fw-light me-3">
                                                    <i class="fa-solid fa-person text-red"></i> <?= $listing->guests ?>
                                                </div>
                                            <?php endif; ?>
    
        
                                        </div>
        
                                        <p class="fw-light">
                                            <?= substr(get_the_excerpt( $listing->ID ), 0, 150) ?>...
                                        </p>
        
                                        <hr class="text-blue opacity-100">
                                        <div class="text-blue fs-4">$<?= number_format($listing->price) ?> MXN <?php pll_e('por noche') ?></div>
                                    </div>
        
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

                <?= get_template_part( 'partials/content', 'contact-form' ); ?>

            <?php endwhile; ?>
            
        <?php endif; ?>

    </article>



<?php get_footer(); ?>