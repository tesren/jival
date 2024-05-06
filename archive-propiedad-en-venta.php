<?php get_header(); ?>

    <section>

        <?php if ( have_posts() ): ?>

            <div class="py-5 mb-5" style="background-image:url('<?= get_template_directory_uri().'/assets/images/forest.webp' ?>');">
                <h1 class="fs-1 text-white fw-bold text-center mb-0 fw-light">
                    <?php pll_e('Propiedades en');?> <strong><?php pll_e('venta');?></strong>
                </h1>
            </div>

            <div class="mb-5 container"><?= get_search_form() ?></div>

            <div class="container row justify-content-center mb-6">

                <?php while( have_posts() ): the_post();?>

                    <div class="col-12 col-lg-4 mb-4 mb-lg-5">

                        <?php
                            $rental_gallery = rwmb_meta('listing_gallery', ['size'=>'medium_large', 'limit'=>1] );
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

                                <img src="<?= $rental_gallery[0]['url'] ?>" class="w-100" alt="<?= get_the_title() ?>" style="height:350px; object-fit:cover;">

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

                <?php endwhile; ?>

                <?php the_posts_pagination( array(
                    'prev_text' => '<<',
                    'next_text' => '>>',
                ) ); ?>

            </div>
            
        <?php endif; ?>

    </section>

    <!-- Formulario de contacto -->
    <?php echo  get_template_part( 'partials/content', 'contact-form' ); ?>

<?php get_footer(); ?>