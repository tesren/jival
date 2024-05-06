<?php
    get_header();
?>

<div class="position-relative mb-6">

    <img src="<?= get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?>" alt="<?= get_the_title() ?>" class="w-100" style="height:25vh; object-fit:cover;">

    <div class="fondo-oscuro"></div>

    <div class="row position-absolute top-0 start-0 h-100 z-3">
        <div class="col-12 text-center text-white align-self-center">
            <h1><?= get_the_title() ?></h1>
        </div>
    </div>

</div>

<div class="text-blue container mb-6">
    <?php the_content() ?>
</div>


<?php get_footer(); ?>