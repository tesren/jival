<!DOCTYPE html>
<html lang="<?= pll_current_language() ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <?php if(is_front_page()): ?>
      <title> Jival <?php pll_e('Bienes Raíces');?> - <?php pll_e('Venta y Renta de Inmuebles en Las Cañadas, Guadalajara, Jalisco') ?></title>
      <meta name="description" content="<?php pll_e('Jival Bienes Raíces es una agencia inmobiliaria con más de 25 años de experiencia, especializada en el área de Las Cañadas en Guadalajara, Jalisco. Nos dedicamos a ofrecer servicios de alta calidad en la compra, venta y renta de propiedades en esta hermosa región. Nuestro equipo de profesionales altamente capacitados y comprometidos está listo para brindarte asesoramiento personalizado y soluciones inmobiliarias adaptadas a tus necesidades. Confía en Jival Bienes Raíces para encontrar la propiedad de tus sueños en Las Cañadas y sus alrededores.');?>">
    <?php elseif(is_post_type_archive()):?>
      <title><?php the_archive_title() ?> - Jival <?php pll_e('Bienes Raíces');?></title>
      <meta name="description" content="<?php pll_e('Jival Bienes Raíces es una agencia inmobiliaria con más de 25 años de experiencia, especializada en el área de Las Cañadas en Guadalajara, Jalisco. Nos dedicamos a ofrecer servicios de alta calidad en la compra, venta y renta de propiedades en esta hermosa región. Nuestro equipo de profesionales altamente capacitados y comprometidos está listo para brindarte asesoramiento personalizado y soluciones inmobiliarias adaptadas a tus necesidades. Confía en Jival Bienes Raíces para encontrar la propiedad de tus sueños en Las Cañadas y sus alrededores.');?>">
    <?php elseif( is_page() ):?>
      <title><?php echo single_post_title(); ?> - Jival <?php pll_e('Bienes Raíces');?></title>
      <meta name="description" content="<?php echo get_the_excerpt(); ?>">
    <?php else: ?>
      <title><?php echo the_title(); ?> - Jival <?php pll_e('Bienes Raíces');?></title>
      <meta name="description" content="<?php echo get_the_excerpt(); ?>">
    <?php endif; ?>


    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/all.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/all.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/fancybox.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/fancybox.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/splide.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/splide.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/jival_styles.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/jival_styles.css">

    <!-- CSS -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

<nav class="navbar navbar-expand-xl bg-white blue-text sticky-top shadow-4">
  <div class="container-fluid">

    <a class="navbar-brand" href="<?= get_home_url();?>">
      <img width="250px" src="<?php echo get_template_directory_uri();?>/assets/images/jival-logo.webp" alt="Logo de HeyHaus">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

      <div class="offcanvas-header">
        <div class="offcanvas-title" id="offcanvasNavbarLabel">
            <img class="w-100 px-4" src="<?php echo get_template_directory_uri();?>/assets/images/jival-logo.webp" alt="Logo de HeyHaus">
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body pe-4">
        <?php
            wp_nav_menu( array(
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'ul',
                //'container_class'   => ' list-unstyled',
                'container_id'      => 'navbarSupportedContent',
                'menu_class'        => 'navbar-nav justify-content-end flex-grow-1 pe-3 fw-bold',
                //'menu_id'           => '',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
            ) );
        ?>
      </div>

    </div>

  </div>
</nav>