<?php 
    
    $featured_listings = get_posts(array(
        'post_type' => 'propiedad-en-venta',
        'numberposts' => -1,
        'meta_query'=> array(
            array(
                'key' => 'featured_listing',
                'compare' => '=',
                'value' => 1,
            )
        ),
    ));

    $featured_rentals = get_posts(array(
        'post_type' => 'alojamiento',
        'numberposts' => -1,
        'meta_query'=> array(
            array(
                'key' => 'featured_rental',
                'compare' => '=',
                'value' => 1,
            )
        ),
    ));

    get_header();
?>

<!-- Inicio -->
<div class="row bg-red mb-0 position-relative">

    <div class="col-12 col-lg-3 bg-red py-5 px-3 px-lg-5 align-self-center d-none d-lg-block">
        <h1 class="fw-light"><span class="fw-semibold"><?php pll_e('Invierte') ?></span> <?php pll_e('en las cañadas country club') ?></h1>
        <hr class="opacity-100">
        <div class="fs-1" style="line-height:1;"> <span style="font-size:100px;">25</span> <?php pll_e('años de experiencia') ?> </div>
    </div>

    <div class="position-absolute bottom-0 start-0 w-100 py-2 px-5 bg-red z-3 mb-5 d-block d-lg-none" style="opacity:0.85;">
        <div class="fs-1 fw-light lh-1"><span class="fw-semibold"><?php pll_e('Invierte') ?></span> <?php pll_e('en las cañadas country club') ?></div>
        <hr class="opacity-100 my-2">
    </div>

    <div class="col-12 col-lg-9 px-0">
        <section class="splide" id="home-gallery">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <img src="<?= get_template_directory_uri()?>/assets/images/jival-home-1.webp" alt="Jival Bienes Raíces" class="w-100" style="min-height:55vh; object-fit:cover;">
                    </li>
                    <li class="splide__slide">
                        <img src="<?= get_template_directory_uri()?>/assets/images/jival-home-2.webp" alt="Jival Bienes Raíces" class="w-100" style="min-height:55vh; object-fit:cover;">
                    </li>
                    <li class="splide__slide">
                        <img src="<?= get_template_directory_uri()?>/assets/images/jival-home-3.webp" alt="Jival Bienes Raíces" class="w-100" style="min-height:55vh; object-fit:cover;">
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>

<div class="bg-light text-center p-3 mb-5">
    <h2 class="fw-light text-blue fs-3 mb-0"><?php pll_e('Somos expertos y estamos establecidos en este hermoso fraccionamiento') ?></h2>
</div>

<div class="text-center mb-6">
    <h2 class="mb-4"><?php pll_e('“Nuestras propiedades destacadas”') ?></h2>

    <a href="#featured-listings" class="link-danger text-decoration-none">
        <i class="fa-solid fa-bounce fa-3x fa-arrow-down"></i>
    </a>
</div>

<!-- Propiedades destacadas -->
<?php if( count($featured_listings) > 0 ): ?>
    <div class="py-5 bg-red text-center">
        <hr class="opacity-100 mb-5">

        <h3 class="fw-light border border-1 border-white d-inline-block px-4 py-2 mb-5">
            <?php pll_e('Propiedades en') ?> <strong><?php pll_e('venta') ?></strong>
        </h3>

        <section class="splide mb-5 px-2 px-lg-5" id="featured-listings">

            <div class="splide__track py-3">
                <ul class="splide__list">

                    <?php foreach($featured_listings as $listing): ?>

                        <li class="splide__slide px-1 px-lg-3">

                            <?php
                                $rental_gallery = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1], $listing->ID);
                                $property_type = get_property_type($listing->ID, 'property_type');

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

                            <a href="<?= get_the_permalink( $listing->ID ) ?>" class="card rounded-0 text-decoration-none border-0">

                                <div class="position-relative">
                                    <div class="position-absolute start-50 top-0 bg-light text-blue z-3 px-2 py-1 rounded-2" style="transform:translate(-50%, -50%);">
                                        <?= $prop_icon ?> <?= $property_type ?>
                                    </div>
    
                                    <img src="<?= $rental_gallery[0]['url'] ?>" class="w-100" alt="<?= get_the_title($listing->ID) ?>" style="height:350px; object-fit:cover;">
    
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

                                        <?php if( isset($listing->construction) ): ?>
                                            <div class="fs-4 text-blue fw-light me-3">
                                                <i class="fa-solid fa-house text-red"></i> <?= $listing->construction ?> m²
                                            </div>
                                        <?php endif; ?>

                                        <?php if( isset($listing->lot_area) ): ?>
                                            <div class="fs-4 text-blue fw-light me-3">
                                                <i class="fa-solid fa-maximize text-red"></i> <?= $listing->lot_area ?> m²
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <p class="fw-light">
                                        <?= substr(get_the_excerpt( $listing->ID ), 0, 150) ?>...
                                    </p>

                                    <hr class="text-blue opacity-100">
                                    <div class="text-blue fs-4">$<?= number_format($listing->price) ?> <?= $listing->currency ?></div>
                                </div>

                            </a>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>

        </section>

        <a href="<?= get_post_type_archive_link( 'propiedad-en-venta' ) ?>" class="btn btn-light px-4">
            <?php pll_e('Ver todas') ?>
        </a>
    </div>
<?php endif; ?>

<!-- Alojamientos destacados -->
<?php if( count($featured_rentals) > 0 ): ?>
    <div class="py-5 bg-blue text-center">
        <hr class="opacity-100 mb-5">

        <h3 class="fw-light border border-1 border-white d-inline-block px-4 py-2 mb-5">
            <?php pll_e('Propiedades en') ?> <strong><?php pll_e('renta') ?></strong>
        </h3>

        <section class="splide mb-5 px-2 px-lg-5" id="featured-rentals">

            <div class="splide__track py-3">
                <ul class="splide__list">

                    <?php foreach($featured_rentals as $listing): ?>

                        <?php $gallery = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1], $listing->ID) ?>

                        <li class="splide__slide px-1 px-lg-3">

                            <?php
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

                            <a href="<?= get_the_permalink( $listing->ID ) ?>" class="card rounded-0 text-decoration-none border-0">

                                <div class="position-relative">
                                    <div class="position-absolute start-50 top-0 bg-light text-blue z-3 px-2 py-1 rounded-2" style="transform:translate(-50%, -50%);">
                                        <?= $prop_icon ?> <?= $property_type ?>
                                    </div>
    
                                    <div class="position-absolute end-0 bottom-0 bg-light text-blue z-3 px-2 py-1 rounded-start mb-3">
                                        <?= $listing->status ?>
                                    </div>
    
                                    <img src="<?= $gallery[0]['url'] ?>" class="w-100" alt="<?= get_the_title($listing->ID) ?>" style="height:350px; object-fit:cover;">
    
                                </div>

                                <div class="bg-red card-title mt-2 py-1 fw-light"><?= get_the_title( $listing->ID ) ?></div>

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
                                                <i class="fa-solid text-red fa-person"></i> <?= $listing->guests ?>
                                            </div>
                                        <?php endif; ?>


                                    </div>

                                    <p class="fw-light">
                                        <?= substr(get_the_excerpt( $listing->ID ), 0, 150) ?>...
                                    </p>

                                    <hr class="text-blue opacity-100">
                                    <div class="text-blue fs-4">$<?= number_format($listing->price) ?> MXN por noche</div>
                                </div>

                            </a>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>

        </section>

        <a href="<?= get_post_type_archive_link( 'alojamiento' ) ?>" class="btn btn-light px-4 mb-5">
            <?php pll_e('Ver todas') ?>
        </a>
    </div>
<?php endif; ?>

<!-- Riviera Maya -->
<section class="position-relative">

    <img src="<?= get_template_directory_uri() ?>/assets/images/riviera-maya.webp" alt="Desarrollos en venta en la Riviera Maya - Jival Bienes Raíces" class="w-100" style="min-height:55vh; object-fit:cover;">

    <div class="fondo-azul"></div>
    
    <div class="position-absolute top-0 start-0 row justify-content-center h-100 z-3">

        <div class="col-12 text-center align-self-center">
            <img class="img-fluid px-5" src="<?= get_template_directory_uri() ?>/assets/images/logo-riviera-maya.webp" alt="Logo de Riviera Maya">
            <h4 class="text-white my-3 fs-2 fw-light"><?php pll_e('Descubre los mejores desarrollos de la Riviera Maya') ?></h4>
            <a href="<?= get_post_type_archive_link('desarrollos') ?>" class="btn btn-outline-light rounded-0 fw-light fs-5"><?php pll_e('Más información') ?></a>
        </div>

    </div>

</section>

<!-- 25 años de exp -->
<div class="row justify-content-center justify-content-lg-between my-6">

    <div class="col-3 col-lg-3 ps-0 bg-red align-self-center py-5 "></div>

    <div class="col-9 col-lg-3 fs-1 fw-semibold">
        <div style="line-height:1;">
            <span style="font-size:100px;">25</span> <span class="text-red"><?php pll_e('años') ?></span>
        </div>
        <div><?php pll_e('de experiencia') ?></div>
    </div>

    <div class="col-12 col-lg-4 mt-4 mt-lg-0 text-center text-lg-start">
        <p class="fs-5 fw-light"><?php pll_e('Somos una inmobiliaria con') ?> <strong><?php pll_e('25 años de experiencia que te orientará y acompañará') ?></strong> <?php pll_e('en todo el proceso de la compra, venta y/o renta de tu bien inmueble.') ?></p>
        <a href="#contact" class="btn btn-outline-danger rounded-0 fs-5 px-5">
            <?php pll_e('Contactar') ?>
        </a>
    </div>

</div>

<!-- Formulario de contacto -->
<div>
    <?php echo  get_template_part( 'partials/content', 'contact-form' ); ?>
</div>

<?php get_footer(); ?>