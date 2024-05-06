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

       

    <?php endwhile;?>

<?php endif;?>


<?php get_footer(); ?>