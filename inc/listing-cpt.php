<?php
add_action( 'init', 'listing_register_post_type' );

function listing_register_post_type(){

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

    register_post_type('propiedad-en-venta', $args);

}

add_action('init', 'listing_register_post_type');



add_filter( 'rwmb_meta_boxes', 'listing_register_meta_boxes' );

function listing_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = [
        'title'      => 'Detalles',
        'post_types' => 'propiedad-en-venta',

        'fields' => [
            [
                'name'  => 'Precio',
                'desc'  => 'Precio de la propiedad',
                'id'    => 'price',
                'type'  => 'number',
                'required'=> true,
                'size' => 30,
            ],
            [
                'name'            => 'Moneda',
                'id'              => 'currency',
                'type'            => 'radio',
                'required'=> true,

                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    'USD'       => 'USD',
                    'MXN'       => 'MXN',
                ),
            ],
            [
                    'name'       => 'Tipo propiedad',
                    'id'         => 'taxonomy',
                    'type'       => 'taxonomy',

                    // Taxonomy slug.
                    'taxonomy'   => 'property_type',

                    // How to show taxonomy.
                    'field_type' => 'radio_list',
            ],
            [
                'name'            => 'Disponibilidad',
                'id'              => 'status',
                'type'            => 'select',
                'required'        => true,
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    'Disponible'  => 'Disponible',
                    'Apartado'    => 'Apartado',
                    'Vendido'     => 'Vendido',
                ),
                // Allow to select multiple value?
                'multiple'        => false,
                // Placeholder text
                'placeholder'     => 'Elige una opción',
                // Display "Select All / None" button?
                'select_all_none' => false,
                'size' => 30,
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
            ],
            [
                'name'  => 'Lote',
                'desc'  => 'Solo números (m2)',
                'id'    => 'lot_area',
                'type'  => 'number',
                'size' => 30,
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
            ],
            [
                'name' => 'Mostrar en Página de inicio',
                'id'   => 'featured_listing',
                'type' => 'checkbox',
                'std'  => 0, // 0 or 1
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
            // More fields.
        ],
    ];


    // Add more field groups if you want
    $meta_boxes[] = [
        
        'title' => 'Galería',
        'post_types' => 'propiedad-en-venta',

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
        'post_types' => 'propiedad-en-venta',

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