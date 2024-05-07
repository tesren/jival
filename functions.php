<?php
/**
 * Jival functions and definitions
 */


if ( ! function_exists( 'jival_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @return void
	 */
	function jival_theme_support() {

		// Add support 
		add_theme_support('title-tag');
		add_theme_support('custom-logo');
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-header' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

endif;

//ENABLE CUSTOM MENU

function custom_nav_menus()
{    
    $locations = array(
        'primary' => __( 'Menu principal' ),
    );
    
    register_nav_menus( $locations );
}

add_action('init', 'custom_nav_menus');



add_action( 'after_setup_theme', 'jival_theme_support' );

if ( ! function_exists( 'jival_theme_styles' ) ) :

	/*
	* Enqueue styles.
	*/

	function jival_theme_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;

		wp_register_style(
			'jival-theme-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'jival-theme-style' );
	}

endif;

add_action( 'wp_enqueue_scripts', 'jival_theme_styles' );

function change_my_title( $title ){
    if ( $title == "Archivos: <span>Propiedad</span>" ){
		$title = "Propiedades en venta";
	}
	elseif( $title == 'Archivos: <span>Alojamiento</span>' ){
		$title = "Renta de Propiedades";
	}
	elseif( $title == 'Archivos: <span>Desarrollos</span>' ){
		$title = "Desarrollos inmobiliarios en la Riviera Maya";
	}

    return $title;
}
add_filter( "get_the_archive_title", "change_my_title" );

/**
 * Jival Custom Post Types
*/

require get_template_directory().'/inc/listing-cpt.php';
require get_template_directory().'/inc/rentals-cpt.php';
require get_template_directory().'/inc/developments-cpt.php';
require get_template_directory().'/inc/sales-team-cpt.php';
require get_template_directory().'/inc/messages-cpt.php';


/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );


/**
 * Jival Custom Functions
*/
function get_list_terms($postID, $taxonomy){
	$terms_list = array_reverse(wp_get_post_terms( $postID, $taxonomy ) );

	$j =1;
	if ( ! empty( $terms_list ) && ! is_wp_error( $terms_list ) ) {
		foreach ( $terms_list as $term ) {
			echo $term->name;
			if( $j < count($terms_list) ){
				echo ', ';
			}
			$j++;
		}
	}
}

function get_property_type($postID, $taxonomy){
        
	$terms_list = array_reverse(wp_get_post_terms( $postID, $taxonomy ) );

	if ( ! empty( $terms_list ) && ! is_wp_error( $terms_list ) ) {
		foreach ( $terms_list as $term ) {
			return $term->name;
		}
	}
}

function jival_set_strings_transtaltion(){
        
	
	$strings = [
		'bedrooms' => 'Recámaras',
		'bathrooms' => 'Baños',
		'total_const' => 'Conts. Total',
		'lot_area' => 'Lote',
		'description'=>'Descripción',
		'amenities' => 'Amenidades',
		'wpp_text' => 'Contactar por WhatsApp',
		'available' => 'Disponible',
		'pending' => 'Apartado',
		'sold' => 'Vendido',
		'zone' => 'Zona',
		'any_zone' => 'Cualquier Zona',
		'property_type' => 'Tipo de propiedad',
		'condos' => 'Condominios',
		'houses' => 'Casas y Villas',
		'lotes' => 'Lotes y Terrenos',
		'business' => 'Negocios',
		'multi_family' => 'Multi Familiar',
		'no_minimum' => 'Sin mínimo',
		'no_max' => 'Sin Máximo',
		'search' => 'Buscar',
		'search_results' => 'Resultados de la Busqueda',
		'no_results' => 'Lo sentimos, no hay resultados',
		'but_more_listings' => 'Pero estas propiedades podrían interesarte',
		'exclusive_properties' => 'Propiedades Exclusivas',
		'View Photos' => 'Ver Galería',
		'location' => 'Ubicación',
		'all_listings'=>'Todas las Propiedades',
		'luxury_listings' => 'Propiedades de lujo',
		'property_search' => 'Búsqueda de propiedades',
		'properties_on_sale' => 'Propiedades en venta',
		'all_types' => 'Todo',
		'fractional' => 'Fraccional',
		'common_interest' => 'Interés Común',
		'land' => 'Lotes',
	];

	$translations = [];

	foreach($strings as $string => $value ){
		$translations[] = [
			'name' => $string,
			'string' => $value,
			'group' => 'Translations',
			'multiline'=>false,
		];
	}


	foreach ($translations as $string ) {
		pll_register_string( $string['name'], $string['string'], $string['group'], $string['multiline'] );
	};

}

add_action('init', 'jival_set_strings_transtaltion');