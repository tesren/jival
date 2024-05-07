<?php

    /*
		==========================================
			CUSTOM PROPERTIES POST TYPE
		==========================================

    */
    function jival_developments_cpt(){

        $labels = array(
            'name' => 'Desarrollos',
            'singular_name' => 'Desarrollo',
            'add_new' => 'Agregar Desarrollo',
            'all_items' => 'Todos los Desarrollos',
            'add_new_items' => 'Agregar Desarrollo',
            'edit_item' => 'Editar Desarrollo',
            'new_item' => 'Nuevo Desarrollo',
            'view_item' => 'Ver Desarrollo',
            'search_item' => 'Buscar Desarrollo',
            'not_found' => 'No se encontraron Desarrollos',
            'parent_item_colon' => 'Desarrollo padre',
            'add_new_item' =>  'Agregar Desarrollo' ,

        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'publicly_queryable' =>  true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'supports' => array(
                'title',
                'editor',
                //'excerpt', 
                //'thumbnail',
                'revisions',
                //'page-attributes',
            ),
            //'taxonomies' => array('category', 'post_tag'),
            'menu_icon' => 'dashicons-building',
            'menu_positions' => 17,
            'exclude_from_search' => false,
            'show_in_nav_menus' => true,
        );

        register_post_type('desarrollos', $args);

    }

    add_action('init', 'jival_developments_cpt');



    
add_filter( 'rwmb_meta_boxes', 'developments_register_meta_boxes' );

function developments_register_meta_boxes( $meta_boxes ) {
    

    $meta_boxes[] = [
        
        'title' => 'Información del Desarrollo',
        'post_types' => 'desarrollos',

        'fields' => [
            [
                'name'  => 'Precios desde',
                'desc'  => 'Ingrese el precio mas bajo del desarrollo',
                'id'    => 'price',
                'type'  => 'number',
                'required'=> true,
                'size'  => 30,
            ],
            [
                'name'            => 'Moneda',
                'id'              => 'currency',
                'type'            => 'radio',
                // Array of 'value' => 'Label' pairs
                'options'         => array(
                    'USD'       => 'USD',
                    'MXN'       => 'MXN',
                ),
            ],
            [
                'name'       => 'Tipo de propiedad',
                'id'         => 'taxonomy',
                'type'       => 'taxonomy',
                'desc'       => 'El tipo de propiedad en venta del desarrollo',

                // Taxonomy slug.
                'taxonomy'   => 'property_type',

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
                'name'    => 'Amenidades',
                'id'      => 'amenities',
                'type'    => 'checkbox_list',
                'inline'  => 'true',
                // Options of checkboxes, in format 'value' => 'Label'
                'options' => [
                    'Pool' => 'Alberca',
                    'Kids Pool' => 'Alberca para niños',
                    'Bar' => 'Bar',
                    'Restaurant' => 'Restaurante',
                    'Rooftop' => 'Terraza',
                    'Gym' => 'Gimnasio',
                    'Spa' => 'Spa',
                    'Gardens' => 'Jardines',
                    'Jacuzzi' => 'Jacuzzi',
                    'Grill' => 'Parrilla',
                    'Sauna' => 'Sauna',
                    'Palm roof' => 'Palapa',
                    'Kids Area' => 'Área para niños',
                    'Picnic Area' => 'Área de picnic',
                    'Beach Access' => 'Acceso a la playa',
                    'Beach Club' => 'Club de playa',
                    'Elevator' => 'Ascensor',
                    'Parking' => 'Estacionamiento',
                    'Storage Area' => 'Área de almacenamiento',
                    'Service Room' => 'Cuarto de servicio',
                    'Laundry Room' => 'Cuarto de lavado',
                    'Balcony' => 'Balcón',
                    'Controled Access' => 'Acceso controlado',
                    '24hr Security' => 'Seguridad 24 horas',
                    'Golf' => 'Golf',
                    'Basketball court' => 'Cancha de baloncesto',
                    'Tennis court' => 'Cancha de tenis',
                    'Skate Park' => 'Parque de patinaje',
                    'Offices' => 'Oficinas',
                    'Cinema Room' => 'Sala de cine',
                    'Gaming Room' => 'Sala de juegos',
                    'Zoom Room' => 'Sala de Zoom',
                    'Coworking' => 'Espacio de coworking'
                ],
                
                // Display options in a single row?
                // 'inline' => true,
                // Display "Select All / None" button?
                'select_all_none' => false,
            ],
            
        ]
    ]; 

   

    $meta_boxes[] = [
        
        'title' => 'Galería de fotos generales',
        'post_types' => 'desarrollos',

        'fields' => [
            [
                'id'               => 'gallery',
                'name'             => 'Suba fotos generales del desarrollo',
                'type'             => 'image_advanced',
                'desc'             => 'Suba por lo menos 5 imagenes generales del desarrollo',
                'required'         => true,

                // Delete file from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same file for multiple posts
                'force_delete'     => false,

                // Maximum file uploads.
                'max_file_uploads' => 30,

                // Do not show how many files uploaded/remaining.
                'max_status'       => 'false',

                // Image size that displays in the edit page.
                'image_size'       => 'thumbnail',
            ],
        ]
    ];

    $meta_boxes[] = [
        
        'title' => 'Ubicación',
        'post_types' => 'desarrollos',

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
                'id'            => 'development_map',
                'name'          => 'Ubicación',
                'type'          => 'map',
                'address_field' => 'address',

                // Default location: 'latitude,longitude[,zoom]' (zoom is optional)
                'std'           => '20.654910, -105.227724, 14',

                // Address field ID
                'address_field' => 'address',

                // Google API key
                'api_key'       => 'AIzaSyDlDmMESUjBK1gwNJm5x4hyoS90qacpJmY',
            ]
        ],
    ];

    $meta_boxes[] = [
        
        'title' => 'Unidad Modelo',
        'post_types' => 'desarrollos',

        'fields' => [
     
            [
                'name'        => 'Descripción Unidad modelo',
                'id'          => 'model_desc',
                'type'        => 'textarea',
                'placeholder' => 'Descripción general de la unidad modelo y de sus interiores',
            ],
            [
                'id'               => 'model_gallery',
                'name'             => 'Suba fotos de la unidad modelo en caso de haber',
                'type'             => 'image_advanced',
                'desc'             => 'Suba por lo menos 5 imagenes',
                'required'         => false,

                // Delete file from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same file for multiple posts
                'force_delete'     => false,

                // Maximum file uploads.
                'max_file_uploads' => 20,

                // Do not show how many files uploaded/remaining.
                'max_status'       => 'false',

                // Image size that displays in the edit page.
                'image_size'       => 'thumbnail',
            ],
        ],
    ];

    return $meta_boxes;
}


/* add_filter( 'rwmb_meta_boxes', 'development_inventory_register_meta_boxes' );

 function development_inventory_register_meta_boxes( $meta_boxes ) {
    
     $meta_boxes[] = [
        'title'      => 'Detalles',
        'post_types' => 'inventory',

        'fields' => [
            [
                'name'  => 'Recámaras',
                'desc'  => 'Ingrese las Recámaras',
                'id'    => 'bedrooms',
                'type'  => 'text',
                'required'=> true,
                'size' => 30,
            ],
            [
                'name'  => 'Baños',
                'desc'  => 'Ingrese los baños completos',
                'id'    => 'bathrooms',
                'type'  => 'text',
                'required'=> true,
                'size' => 30,
            ],
            [
                'name'  => 'Construcción',
                'desc'  => 'Solo números (m2)',
                'id'    => 'construction',
                'type'  => 'text',
                'required'=> true,
                'size' => 30,
            ],
            [
                'name'  => 'Detalles extra',
                'desc'  => 'Escriba algun detalle extra',
                'id'    => 'extra_features',
                'type'  => 'text',
                'clone'=> true,
            ],
            [
                'id'               => 'inventory_gallery',
                'name'             => 'Imagenes de la unidad',
                'type'             => 'image_advanced',
                'desc'             => 'Suba un máximo de 10 imágenes',

                // Delete file from Media Library when remove it from post meta?
                // Note: it might affect other posts if you use same file for multiple posts
                'force_delete'     => false,

                // Maximum file uploads.
                'max_file_uploads' => 3,

                // Do not show how many files uploaded/remaining.
                'max_status'       => 'false',

                // Image size that displays in the edit page.
                'image_size'       => 'thumbnail',
            ],

           
            
            // More fields.
        ],
    ];

    return $meta_boxes;
}  */