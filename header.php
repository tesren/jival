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


    <!-- Google analytics tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M0E29J6TH8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-M0E29J6TH8');
    </script>


    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/bootstrap.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/all.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/all.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/fancybox.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/fancybox.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/splide.min.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/splide.min.css">

    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/assets/css/jival_styles-v1.css" as="style">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/jival_styles-v1.css">

    <!-- CSS -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

<nav class="navbar navbar-expand-xxl bg-white blue-text sticky-top shadow-4">
  <div class="container-fluid">

    <a class="navbar-brand w-25" href="<?= get_home_url();?>">
      <picture>
        <!-- Imagen para pantallas de escritorio -->
        <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri()?>/assets/images/jival-logo.webp">
    
        <!-- Imagen para pantallas de teléfono -->
        <source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri()?>/assets/images/logo-jival-vertical-azul.webp">
    
        <!-- Fallback para navegadores que no soportan <picture> -->
        <img src="<?php echo get_template_directory_uri()?>/assets/images/jival-logo.webp" alt="Logo de Jival Bienes Raíces" class="col-6 col-lg-8 d-inline">
      </picture>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

      <div class="offcanvas-header">
        <div class="offcanvas-title" id="offcanvasNavbarLabel">
          <img class="w-100 px-4" src="<?php echo get_template_directory_uri();?>/assets/images/jival-logo.webp" alt="Logo de Jival Bienes Raíces">
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

        <div class="text-center fs-5 my-3 my-lg-1">
          <a href="https://www.facebook.com/JivalBR" target="_blank" rel="noopener noreferrer" class="text-blue text-decoration-none me-3 me-lg-1">
              <i class="fa-brands fa-facebook"></i>
          </a>

          <a href="https://www.instagram.com/jivalbienesraices" target="_blank" rel="noopener noreferrer" class="text-blue text-decoration-none me-3 me-lg-1">
              <i class="fa-brands fa-instagram"></i>
          </a>

          <a href="https://www.tiktok.com/@jivalbr" target="_blank" rel="noopener noreferrer" class="text-blue text-decoration-none me-3 me-lg-1">
              <i class="fa-brands fa-tiktok"></i>
          </a>

          <a href="https://www.youtube.com/@JivalBR/featured" target="_blank" rel="noopener noreferrer" class="text-blue text-decoration-none me-lg-1">
              <i class="fa-brands fa-youtube"></i>
          </a>
        </div>

      </div>

    </div>

  </div>
</nav>