<?php
add_action( 'init', 'rentals_register_post_type' );

function rentals_register_post_type(){

    $labels = array(
        'menu_name'          =>  'Alojamientos' ,
        'name_admin_bar'     =>  'Alojamientos' ,
        'add_new'            =>  'Agregar Alojamiento' ,
        'add_new_item'       =>  'Agregar Alojamiento' ,
        'new_item'           =>  'Nueva Alojamiento' ,
        'edit_item'          =>  'Editar Alojamiento' ,
        'view_item'          =>  'Ver Alojamiento' ,
        'update_item'        =>  'Actualizar Alojamiento' ,
        'all_items'          =>  'Todas las Alojamientos' ,
        'search_items'       =>  'Buscar Alojamientos' ,
        'parent_item_colon'  =>  'Padre Alojamiento' ,
        'not_found'          =>  'No se encontraron Alojamientos' ,
        'not_found_in_trash' =>  'No hay Alojamientos en la papelera' ,
        'name'               =>  'Alojamiento' ,
        'singular_name'      =>  'Alojamiento' ,

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
        'menu_icon' => 'dashicons-admin-multisite',
        'menu_positions' => 7,
        'exclude_from_search' => false

    );

    register_post_type('alojamiento', $args);

}

add_action('init', 'rentals_register_post_type');


function jival_rentals_custom_taxonomies(){

    //add new taxonomi heirarchical
    $labels = array(
        'name' => 'Tipo de Alojamiento', 
        'singular_name' => 'Tipo de Alojamiento',
        'search_items' => 'Buscar Alojamientos',
        'all_items' => 'Todos los Alojamiento',
        'parent_item' => 'Alojamiento Padre', 
        'parent_item_colon' => 'Alojamiento Padre:',
        'edit_item' => 'Editar Alojamiento',
        'update_item' => 'Actualizar Alojamiento',
        'add_new_item' => 'Agregar nuevo Alojamiento', 
        'new_item_name' => 'Nuevo Alojamiento',
        'menu_name' => 'Tipo de Alojamiento'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_in_menu' => true,
        'show_ui' => true,
        'show_admin_column' => true, //muestra u oculta la columna en vista admon para filtrar
        'query_var' => true,
        'rewrite' => array('slug' => 'rental-type') //Este parametro saldra en la URL
    );

    register_taxonomy('rental-type', array('alojamiento'), $args );

}

add_action('init', 'jival_rentals_custom_taxonomies');



add_filter( 'rwmb_meta_boxes', 'rentals_register_meta_boxes' );

function rentals_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = [
        'title'      => 'Detalles',
        'post_types' => 'alojamiento',

        'fields' => [
            /* [
                'name'  => 'Precio por noche',
                'desc'  => 'Precio por noche del Alojamiento en pesos mexicanos',
                'id'    => 'price',
                'type'  => 'number',
                'size'    => 30,
                'required'=> false
            ], */
            [
                'name'  => 'Precio por mes',
                'desc'  => 'Precio por mes del Alojamiento en pesos mexicanos',
                'id'    => 'price_month',
                'type'  => 'number',
                'size'    => 30,
            ],
            [
                    'name'       => 'Tipo de Alojamiento',
                    'id'         => 'taxonomy',
                    'type'       => 'taxonomy',

                    // Taxonomy slug.
                    'taxonomy'   => 'rental-type',

                    // How to show taxonomy.
                    'field_type' => 'radio_list',
            ],
            [
                'name'       => 'Ubicación',
                'id'         => 'location',
                'type'       => 'taxonomy',
                // Taxonomy slug.
                'taxonomy'   => 'regiones',

                // How to show taxonomy.
                'field_type' => 'select_tree',
            ],
             [
                'name'  => 'Recámaras',
                'desc'  => 'Solo numeros',
                'id'    => 'bedrooms',
                'type'  => 'number',
                'size' => 30,
                'required'=> true
            ],
            [
                'name'  => 'Baños',
                'desc'  => 'Solo números',
                'id'    => 'bathrooms',
                'type'  => 'number',
                'size' => 30,
                'step' => 0.5
            ],
            
            [
                'name'  => 'Huéspedes',
                'desc'  => 'Cantidad máxima de personas admitidas',
                'id'    => 'guests',
                'type'  => 'number',
                'size' => 30,
                'required'=> true
            ],
            
            [
                'name' => 'Mostrar en Página de inicio',
                'id'   => 'featured_rental',
                'type' => 'checkbox',
                'std'  => 0, // 0 or 1
            ],
            [
                'name'    => 'Amenidades y/o servicios',
                'id'      => 'amenities',
                'type'    => 'text',
                'placeholder'=> 'Escriba una Amenidad',
                'clone'=> true,
                'size' => 30,
            ],
            
            // More fields.
        ],
    ];


    // Add more field groups if you want
    $meta_boxes[] = [
        
        'title' => 'Galería',
        'post_types' => 'alojamiento',

        'fields' => [
            [
                'id'               => 'listing_gallery',
                'name'             => 'Imagenes del alojamiento',
                'type'             => 'image_advanced',
                'required'=> true,

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
        'post_types' => 'alojamiento',

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
        'post_types' => 'alojamiento',

        'fields' => [
            // Address field.
            [
                'id'   => 'address',
                'name' => 'Domicilio',
                'type' => 'text',
                'placeholder' => 'Escriba el domicilio completo de la propiedad',
                'required'=> true
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