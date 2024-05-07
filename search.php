<?php

    $regiones = get_terms( array(
        'taxonomy'          => 'regiones',
        'parent'            => 0,
        'hide_empty'        => false,
    ) );

    $propertiesType = get_terms( array(
        'taxonomy'          => 'property_type',
        'parent'            => 0,
        'hide_empty'        => false,
    ) );

    if($_GET['regiones_s'] && !empty($_GET['regiones_s']))
    {
        $regiones_s = $_GET['regiones_s'];

    }
    else{
        $regiones_s = array(); 

        //Recuerda que si no tiene parent no funciona la busqueda
        foreach($regiones as &$category):
            $childrenTerms =  get_term_children( $category->term_id, 'regiones' );

            foreach($childrenTerms as $child) :     
                $term = get_term_by( 'id', $child, 'regiones');
                array_push($regiones_s, $term->slug);
            endforeach; 

         endforeach;
    }

    if($_GET['min_price'] && !empty($_GET['min_price']))
    {
        $minprice = $_GET['min_price'];
    } else {
        $minprice = 0;
    }

    if($_GET['max_price'] && !empty($_GET['max_price']))
    {
        $maxprice = $_GET['max_price'];
    } else {
        $maxprice = 999999999;
    }

    if($_GET['type_s'] && !empty($_GET['type_s']))
    {
        $pType = $_GET['type_s'];
    }
    else{
        $pType = array();

        foreach ($propertiesType as $propertyType){
            array_push($pType, $propertyType->slug);
        } 
    }


    get_header();

    $developments = get_posts(array(
        'post_type' => 'desarrollos',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'property_type',
                'field'    => 'slug',
                'terms'    => $pType,
            ),
            array(
                'taxonomy' => 'regiones',
                'field'    => 'slug',
                'include_children' => true,
                'terms'    => $regiones_s,
            ),
        ),
    ));

    
    $args = array(
        'post_type' => 'propiedad-en-venta',
        'posts_per_page' => 9,
        'meta_query' => array(
            array(
                'key' => 'status',
                'value' => 'Disponible',
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'price',
                'type' => 'NUMERIC',
                'value' => array($minprice, $maxprice),
                'compare' => 'BETWEEN'
            ),
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'property_type',
                'field'    => 'slug',
                'terms'    => $pType,
            ),
            array(
                'taxonomy' => 'regiones',
                'field'    => 'slug',
                'include_children' => true,
                'terms'    => $regiones_s,
            ),
        ),
    );
    

    $query = new WP_Query($args);
    
?>

    <?php// var_dump($query); ?>

    <?php if($query -> have_posts() ):?>

        <div class="py-5 mb-5" style="background-image:url('<?= get_template_directory_uri().'/assets/images/forest.webp' ?>');">
            <h1 class="fs-1 text-white fw-bold text-center mb-0 fw-light">
                <?php pll_e('Resultados de la Busqueda');?>
            </h1>
        </div>

        <div class="col-12 col-lg-8 mb-5 mx-auto">
            <!-- Formulario de busqueda -->
            <?php echo get_search_form();?>
        </div>

        <div class="row container justify-content-evenly">

            <?php while($query ->have_posts() ) : $query ->the_post(); ?>

                <div class="col-12 col-lg-4 mb-4 mb-lg-5">

                    <?php
                        $listing_gallery = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1] );
                        $property_type = get_property_type(get_the_ID(), 'property_type');

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

                    <a href="<?= get_the_permalink(  ) ?>" class="card rounded-0 shadow-4 text-decoration-none border-0">

                        <div class="position-relative">
                            <div class="position-absolute start-50 top-0 bg-light text-blue z-3 px-2 py-1 rounded-2" style="transform:translate(-50%, -50%);">
                                <?= $prop_icon ?> <?= $property_type ?>
                            </div>

                            <img src="<?= $listing_gallery[0]['url'] ?>" class="w-100" alt="<?= get_the_title() ?>" style="height:350px; object-fit:cover;">

                        </div>

                        <div class="bg-blue card-title mt-2 py-1 fw-light text-center"><?= get_the_title(  ) ?></div>

                        <div class="card-body pt-2">

                            <?php
                                $bedrooms = rwmb_meta('bedrooms');
                                $bathrooms = rwmb_meta('bathrooms');
                                $construction = rwmb_meta('construction');
                                $lot_area = rwmb_meta('lot_area');
                            ?>

                            <div class="d-flex justify-content-center">


                                <?php if( isset($bedrooms) ): ?>
                                    <div class="fs-4 text-blue fw-light me-3">
                                        <i class="fa-solid fa-bed text-red"></i> <?= $bedrooms ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( isset($bathrooms) ): ?>
                                    <div class="fs-4 text-blue fw-light me-3">
                                        <i class="fa-solid fa-bath text-red"></i> <?= $bathrooms ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( $construction > 0 ): ?>
                                    <div class="fs-4 text-blue fw-light me-3">
                                        <i class="fa-solid fa-house text-red"></i> <?= $construction ?> m²
                                    </div>
                                <?php endif; ?>

                                <?php if( $lot_area > 0 ): ?>
                                    <div class="fs-4 text-blue fw-light me-3">
                                        <i class="fa-solid fa-maximize text-red"></i> <?= $lot_area ?> m²
                                    </div>
                                <?php endif; ?>

                            </div>

                            <p class="fw-light">
                                <?= substr(get_the_excerpt(  ), 0, 150) ?>...
                            </p>

                            <hr class="text-blue opacity-100">
                            <div class="text-blue text-center fs-4">$<?= number_format(rwmb_meta('price')) ?> <?= rwmb_meta('currency') ?></div>
                        </div>

                    </a>

                </div>
                
            <?php endwhile;?>
        </div>

        <?php the_posts_pagination(); ?>

    <?php else: ?>

        <div class="text-center py-5 bg-light">
            <h1 class="fs-1 blue-text"><?php pll_e('Lo sentimos, no hay resultados'); ?></h1>
            <h2 class="fs-4 fw-light gold-text"><?php pll_e('Pero estas propiedades podrían interesarte'); ?></h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 mb-5">
                <!-- Formulario de busqueda -->
                <?php echo get_search_form();?>
            </div>
        </div>

        <?php
            $more_listings =  get_posts(array('post_type' => 'propiedad-en-venta','numberposts' => 3,)); 
        ?>

        <div class="container row justify-content-evenly">
            <?php foreach($more_listings as $listing): ?>

                <div class="col-12 col-lg-4 mb-4 mb-lg-5 shadow-4 px-0 rounded-2 blog-card">

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

                        <div class="bg-blue card-title mt-2 py-1 fw-light text-center"><?= get_the_title( $listing->ID ) ?></div>

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
                            <div class="text-blue fs-4 text-center">$<?= number_format($listing->price) ?> <?= $listing->currency ?></div>
                        </div>

                    </a>
                    
                </div>

            <?php endforeach; ?>
        </div>
       

    <?php endif; ?>

    <?php if($developments): ?>
        <h1 class="fs-2 blue-text fw-bold text-center mt-5 mb-0"><?php pll_e('Desarrollos Inmobiliarios');?></h1>
        <hr class="col-11 col-lg-3 mx-auto mt-0 mb-5">

        <div class="row justify-content-center">
            <?php foreach($developments as $dev): ?>
                <div class="col-11 col-lg-10 col-xl-9 mb-4 mb-lg-5 shadow-4 px-0 rounded-2 blog-card position-relative z-2">

                    <a href="<?= get_the_permalink($dev->ID); ?>" class="text-decoration-none">
                        <div class="card w-100 text-dark fw-normal position-relative">

                            <div class="badge bg-blue position-absolute top-0 start-0 ms-3 mt-3 z-3">
                                <?php get_property_type($dev->ID , 'property_type') ?>
                            </div>

                            <div class="row g-0">

                                <?php $images = rwmb_meta('gallery', ['size'=>'medium-large', 'limit'=>1], $dev->ID) ;?>
                                <div class="col-12 col-lg-7">
                                    <img src="<?= $images[0]['url'] ?>" class="w-100 rounded-start" alt="<?= get_the_title($dev->ID);?>" style="max-height:450px; object-fit:cover;">
                                </div>

                                <div class="col-12 col-lg-5">
                                    <div class="card-body">
                                        <h2 class="fw-bold blue-text mb-1 fs-1"><?= get_the_title($dev->ID);?></h2>
                                        <h3 class="fw-light gold-text fs-4 mb-3"><?php get_list_terms($dev->ID, 'regiones'); ?></h3>

                                        <p class="card-text fs-5"><?= get_the_excerpt($dev->ID);?></p>

                                        <div class="fs-4 fw-light blue-text">
                                            <?php pll_e('Precios desde')?>: 
                                            <span class="fw-bolder">
                                                $<?= number_format($dev->price) ?> <span class="fs-5"><?= $dev->currency ?></span>
                                            </span> 
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                    
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

<?php get_footer(); ?>