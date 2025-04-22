<?php
add_action( 'init', 'property_register_post_type' );

function property_register_post_type(){

    $labels = array(
        'menu_name'          =>  'Propiedades' ,
        'name_admin_bar'     =>  'Propiedades' ,
        'add_new'            =>  'Agregar Propiedad' ,
        'add_new_item'       =>  'Agregar Propiedad' ,
        'new_item'           =>  'Nueva Propiedad' ,
        'edit_item'          =>  'Editar Propiedad' ,
        'view_item'          =>  'Ver Propiedad' ,
        'update_item'        =>  'Actualizar Propiedad' ,
        'all_items'          =>  'Todas las Propiedades' ,
        'search_items'       =>  'Buscar Propiedades' ,
        'parent_item_colon'  =>  'Padre Propiedad' ,
        'not_found'          =>  'No se encontraron Propiedades' ,
        'not_found_in_trash' =>  'No hay Propiedades en la papelera' ,
        'name'               =>  'Propiedad' ,
        'singular_name'      =>  'Propiedad' ,

    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' =>  true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            //'excerpt',
            //'thumbnail',
            'revisions',
        ),
        //'taxonomies' => array('category', 'post_tag'),
        'menu_icon' => 'dashicons-admin-home',
        'menu_positions' => 7,
        'exclude_from_search' => false

    );

    register_post_type('propiedad', $args);

}

add_action('init', 'property_register_post_type');


function listings_custom_taxonomies(){

    //add new taxonomi heirarchical
    $labels = array(
        'name' => 'Tipo de Propiedad', //Puede ser casas, depas, terrenos
        'singular_name' => 'Tipo de Propiedad',
        'search_items' => 'Buscar Tipos',
        'all_items' => 'Todos los tipos',
        'parent_item' => 'Tipo padre', 
        'parent_item_colon' => 'Tipo padre:',
        'edit_item' => 'Editar Tipo',
        'update_item' => 'Editar tipo',
        'add_new_item' => 'Agregar nuevo tipo', 
        'new_item_name' => 'Nuevo Tipo de propiedad',
        'manu_name' => 'Tipo de Propiedad'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_in_menu' => true,
        'show_ui' => true,
        'show_admin_column' => true, //muestra u oculta la columna en vista admon para filtrar
        'query_var' => true,
        'rewrite' => array('slug' => 'tipo-propiedad') //Este parametro saldra en la URL
    );

    register_taxonomy('property_type', array('propiedad-en-venta', 'desarrollos', 'propiedad'), $args );

    //add new taxonomy NOT heirarchical

     register_taxonomy('regiones', array('propiedad-en-venta', 'propiedad'), array(
        'label' => 'Áreas',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_admin_column' => true, //muestra u oculta la columna en vista admon para filtrar
        'query_var' => true,
        'rewrite' => array('slug' => 'area'), //Este parametro saldra en la URL
        'hierarchical' => true,
    ));



}

add_action('init', 'listings_custom_taxonomies');


add_filter( 'rwmb_meta_boxes', 'propery_register_meta_boxes' );

function propery_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = [
        'title'      => 'Detalles',
        'post_types' => 'propiedad',
        'fields' => [
            [
                'name'    => '¿Está en venta o renta?',
                'id'      => 'operation_type',
                'type'    => 'radio',
                'options' => [
                    'venta' => 'Venta',
                    'renta' => 'Renta',
                ],
                'inline'  => true,
                'required' => true,
            ],
            [
                'name'  => 'Precio',
                'desc'  => 'Precio de la propiedad',
                'id'    => 'price',
                'type'  => 'number',
                'required'=> true,
                'size' => 30,
                'visible' => [ 'operation_type', '=', 'venta' ],
            ],
            [
                'name'            => 'Moneda',
                'id'              => 'currency',
                'type'            => 'radio',
                'required'=> true,
                'options'         => array(
                    'USD'       => 'USD',
                    'MXN'       => 'MXN',
                ),
                'visible' => [ 'operation_type', '=', 'venta' ],
            ],
            [
                'name'       => 'Tipo propiedad',
                'id'         => 'taxonomy',
                'type'       => 'taxonomy',
                'taxonomy'   => 'property_type',
                'field_type' => 'radio_list',
            ],
            [
                'name'            => 'Disponibilidad',
                'id'              => 'status',
                'type'            => 'select',
                'required'        => true,
                'options'         => array(
                    'Disponible'  => 'Disponible',
                    'Apartado'    => 'Apartado',
                    'Vendido'     => 'Vendido',
                ),
                'multiple'        => false,
                'placeholder'     => 'Elige una opción',
                'select_all_none' => false,
                'size' => 30,
                'visible' => [ 'operation_type', '=', 'venta' ],
            ],
            [
                'name'       => 'Ubicación',
                'id'         => 'location',
                'type'       => 'taxonomy',
                'taxonomy'   => 'regiones',
                'field_type' => 'select_tree',
            ],
            [
                'name'  => 'Recámaras',
                'desc'  => 'Solo numeros',
                'id'    => 'bedrooms',
                'type'  => 'number',
                'size' => 30,
            ],
            [
                'name'  => 'Baños',
                'desc'  => 'Solo números',
                'id'    => 'bathrooms',
                'type'  => 'number',
                'size' => 30,
            ],
            [
                'name'  => 'Medios Baños',
                'desc'  => 'Solo números',
                'id'    => 'half_baths',
                'type'  => 'number',
                'size' => 30,
            ],
            [
                'name'  => 'Construcción',
                'desc'  => 'Solo números (m2)',
                'id'    => 'construction',
                'type'  => 'number',
                'size' => 30,
                'visible' => [ 'operation_type', '=', 'venta' ],
            ],
            [
                'name'  => 'Lote',
                'desc'  => 'Solo números (m2)',
                'id'    => 'lot_area',
                'type'  => 'number',
                'size' => 30,
                'visible' => [ 'operation_type', '=', 'venta' ],
            ],
            [
                'name'            => 'Estacionamiento',
                'id'              => 'parking',
                'type'            => 'radio',
                'inline'     => true,
                'options'         => [
                    'Ninguno'        => 'Ninguno',
                    'En propiedad'       => 'En propiedad',
                    'Cochera' => 'Cochera',
                    'Subterráneo'     => 'Subterráneo',
                    'Pérgola'      => 'Pérgola',
                    'Descubierto'      => 'Descubierto',
                    'Torre de estacionamiento'      => 'Torre de estacionamiento',
                ],
                'visible' => [ 'operation_type', '=', 'venta' ],
            ],
            [
                'name' => 'Mostrar en Página de inicio',
                'id'   => 'featured_listing',
                'type' => 'checkbox',
                'std'  => 0, // 0 or 1
                'visible' => [ 'operation_type', '=', 'venta' ],
            ],
            // Campos solo para renta
            [
                'name'  => 'Precio por noche',
                'desc'  => 'Precio por noche del Alojamiento en pesos mexicanos',
                'id'    => 'price_night',
                'type'  => 'number',
                'size'  => 30,
                'visible' => [ 'operation_type', '=', 'renta' ],
            ],
            [
                'name'  => 'Precio por mes',
                'desc'  => 'Precio por mes del Alojamiento en pesos mexicanos',
                'id'    => 'price_month',
                'type'  => 'number',
                'size'  => 30,
                'visible' => [ 'operation_type', '=', 'renta' ],
            ],
            [
                'name'  => 'Huéspedes',
                'desc'  => 'Cantidad máxima de personas admitidas',
                'id'    => 'guests',
                'type'  => 'number',
                'size'  => 30,
                'visible' => [ 'operation_type', '=', 'renta' ],
            ],
            [
                'name' => 'Mostrar en Página de inicio',
                'id'   => 'featured_rental',
                'type' => 'checkbox',
                'std'  => 0,
                'visible' => [ 'operation_type', '=', 'renta' ],
            ],
            [
                'name'    => 'Amenidades',
                'id'      => 'amenities',
                'type'    => 'text',
                'placeholder'=> 'Escriba una Amenidad',
                'clone'=> true,
                'size' => 30,
            ],
            [
                'name'    => 'Enlace de Youtube',
                'id'      => 'youtube_link',
                'type'    => 'text',
                'placeholder'=> 'Enlace al video de Youtube de la propiedad',
                'desc'=> 'Enlace al video de Youtube de la propiedad',
                'size' => 45,
            ],
        ],
    ];


    // Add more field groups if you want
    $meta_boxes[] = [
        
        'title' => 'Galería',
        'post_types' => 'propiedad',

        'fields' => [
            [
                'id'               => 'listing_gallery',
                'name'             => 'Image upload',
                'type'             => 'image_advanced',

                // Delete file from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same file for multiple posts
                'force_delete'     => false,

                // Maximum file uploads.
                'max_file_uploads' => 40,

                // Do not show how many files uploaded/remaining.
                'max_status'       => 'false',

                // Image size that displays in the edit page.
                'image_size'       => 'thumbnail',
            ],
        ]
    ];

  /*   $meta_boxes[] = [
        
        'title' => 'Tour virtual y video del lugar',
        'post_types' => 'propiedad-en-venta',

        'fields' => [
             [
                'id'               => 'listing_video',
                'name'             => 'Video de Youtube',
                'desc'             => 'Por favor pegue el enlace ',
                'type'             => 'oembed',
             ],
            [
                'id'               => 'listing_tour',
                'name'             => 'Link del Tour virtual',
                'desc'             => 'Por favor pegue el enlace del Tour virtual" ',
                'type'             => 'text',
            ],
        ]
    ]; */

     $meta_boxes[] = [
        
        'title' => 'Mapa de Google',
        'post_types' => 'propiedad',

        'fields' => [
            // Address field.
            [
                'id'   => 'address',
                'name' => 'Domicilio',
                'type' => 'text',
                'placeholder' => 'Escriba el domicilio completo de la propiedad'
            ],
            // Map field.
            [
                'id'            => 'map',
                'name'          => 'Ubicación',
                'type'          => 'map',
                'address_field' => 'address',

                // Default location: 'latitude,longitude[,zoom]' (zoom is optional)
                'std'           => '20.6985662,-105.3090504,14',

                // Google API key
                'api_key'       => 'AIzaSyDlDmMESUjBK1gwNJm5x4hyoS90qacpJmY',
            ]
        ],
    ];
    // More fields..

    return $meta_boxes;
}