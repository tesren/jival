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
	elseif( $title == 'Archives: <span>Desarrollos</span>' ){
		$title = "Real Estate Developments in Riviera Maya";
	}
	elseif($title == 'Archives: <span>Propiedad</span>'){
		$title = "Properties for sale";
	}
	elseif($title == 'Archives: <span>Alojamiento</span>'){
		$title = "Properties for rent";
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
		'min_price' => 'Precio min.',
		'max_price' => 'Precio max.',
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
		'properties_for' => 'Propiedades en',
		'rent' => 'renta',
		'discover_maya' => 'Descubre los mejores desarrollos de la Riviera Maya',
		'maya_desc' => 'Trabajamos con los mejores desarrolladores para ofrecerte excelentes oportunidades de vivienda o inversión ubicados en un increible lugar como la Riviera Maya.',
		'maya_desc_2' => 'Vemos por un crecimiento integral y trascendente, cuyo soporte es el amor a la vida y el servicio. Tenemos como prioridad satisfacer las necesidades y deseos de nuestros clientes.',
		'starting_at' => 'Precios desde',
		'sale' => 'venta',
		'contact' => 'Contacto',
		'address'  => 'Domicilio',
		'invest' => 'Invierte',
		'in_cañadas_country' => 'en las cañadas country club',
		'years_exp' => 'años de experiencia',
		'experts_frac' => 'Somos expertos y estamos establecidos en este hermoso fraccionamiento',
		'our_featured_listings' => '“Nuestras propiedades destacadas”',
		'view_all' => 'Ver todas',
		'more_information' => 'Más información',
		'years' => 'años',
		'of_experience' => 'de experiencia',
		'we_are_a_real_estate' => 'Somos una inmobiliaria con',
		'25_years_of_exp' => '25 años de experiencia que te orientará y acompañará',
		'in_all_of_your_process' => 'en todo el proceso de la compra, venta y/o renta de tu bien inmueble.',
		'contact_to' => 'Contactar',
		'real_estate' => 'Bienes Raíces',
		'meta_title' => 'Venta y Renta de Inmuebles en Las Cañadas, Guadalajara, Jalisco',
		'meta_desc' => 'Jival Bienes Raíces es una agencia inmobiliaria con más de 25 años de experiencia, especializada en el área de Las Cañadas en Guadalajara, Jalisco. Nos dedicamos a ofrecer servicios de alta calidad en la compra, venta y renta de propiedades en esta hermosa región. Nuestro equipo de profesionales altamente capacitados y comprometidos está listo para brindarte asesoramiento personalizado y soluciones inmobiliarias adaptadas a tus necesidades. Confía en Jival Bienes Raíces para encontrar la propiedad de tus sueños en Las Cañadas y sus alrededores.',
		'get_in_touch_market' => 'Ponte en contacto con nosotros para brindarte las mejores soluciones del mercado.',
		'write_us' =>'Escríbenos',
		'rent_title' => 'En Jival cuidamos de tu patrimonio, deja en nuestras manos administrar tu propiedad',
		'contact_us' => 'Contáctanos',
		'best_services' => 'Te brindamos los mejores servicios',
		'services_1' => 'Publicamos las propiedades en los mejores portales inmobiliarios, redes sociales y más.',
		'services_2' => 'Investigamos a los inquilinos, a sus fiadores y elaboramos contratos.',
		'services_3' => 'Entregamos la propiedad previo a revisar sus condiciones físicas y respaldando lo anterior con fotografías.',
		'services_4' => 'Estamos al pendiente del pago oportuno de la renta.',
		'services_5' => 'Nos mantenemos atentos a problemas de mantenimiento y reparaciones que puedan surgir en el transcurso del arrendamiento para darles solución y gestionar su pago y cobro según la parte responsable. Contamos con un equipo externo de apoyo de primera, tales como: Fontaneros, electricistas, carpinteros, pintores, albañiles, entre otros.',
		'services_6' => 'Hacemos la renovación del contrato cuando la vigencia del mismo termine y verificamos el estado físico de la propiedad informándole al propietario.',
		'sevices_7'  => 'Recibimos la propiedad cuando el inquilino la entregue verificando el estado físico de la misma, así como, los pagos de los servicios al corriente, y en su momento si procede a la devolución del depósito.',
		'services_8' => 'En todo momento mantenemos comunicación abierta en horario de atención a clientes tanto como del propietario como el inquilino.',
		'services_9' => 'Brindamos asesoría legal gratuita al proipietario que lo requiera sin que ello implique un juicio.',
		'sevices_10' => 'Cobramos un 10% de honorarios del mes total de renta.',
		'sell_prop'  => '¿Quieres vender una propiedad?',
		'trust_us'	 => 'Confía tu patrimonio en nosotros y vive plenamente tranquilo.',
		'who_are_we' => '¿Quiénes somos?',
		'we_are_this'=> 'Somos una inmobiliaria con 25 años de experiencia que te orientará y acompañará en todo el proceso de la compra, venta y/o renta de tu bien inmueble, para que puedas obtener el mayor provecho en términos de tiempo y dinero.',
		'we_have_resource' => 'Contamos con todos los recursos para lograr dicho objetivo',
		'qualified_staff' => 'Nuestros agentes estan altamente calificados en el tema inmobiliario.',
		'empathize_staff' => 'Empatizamos con nuestros clientes para brindarles un servicio personalizado.',
		'legal_assesment' => 'Brindamos asesoría legal y fiscal.',
		'complete_team'	  => 'Contamos con un equipo integral de profesionales reacionados directamente con el medio, Broker hipotecário, valuadores, notarías, arquitectos, topógrafo, abogado, contador, fiscalista y más.',
		'listings_promoted'=> 'Promocionamos las propiedades en los mejores portales inmobiliarios. Colaboramos con otras inmobiliarias para lograr mayor rapidez en las ventas.',
		'meet_our_team' => 'Conoce a nuestro equipo',
		'developments' => 'Desarrollos Inmobiliarios',
		'all_types' => 'Todos los tipos',
		'view_gallery' => 'Ver galería',
		'for_rent' => 'en renta',
		'per_night' => 'Por noche',
		'per_month' => 'Por mes',
		'contact_agent' => 'Contacta un asesor',
		'features_amenities' => 'Características, servicios y amenidades',
		'guests' => 'huéspedes',
		'more_rents' => 'Más propiedades en renta',
		'for_sale' => 'en venta',
		'pool' => 'Pool',
		'kids_pool' => 'Kids Pool',
		'bar' => 'Bar',
		'restaurant' => 'Restaurant',
		'rooftop' => 'Rooftop',
		'gym' => 'Gym',
		'spa' => 'Spa',
		'gardens' => 'Gardens',
		'jacuzzi' => 'Jacuzzi',
		'grill' => 'Grill',
		'sauna' => 'Sauna',
		'palm_roof' => 'Palm roof',
		'kids_area' => 'Kids Area',
		'picnic_area' => 'Picnic Area',
		'beach_access' => 'Beach Access',
		'beach_club' => 'Beach Club',
		'elevator' => 'Elevator',
		'parking' => 'Parking',
		'storage_area' => 'Storage Area',
		'service_room' => 'Service Room',
		'laundry_room' => 'Laundry Room',
		'balcony' => 'Balcony',
		'controled_access' => 'Controled Access',
		'24hr_security' => '24hr Security',
		'golf' => 'Golf',
		'basketball_court' => 'Basketball court',
		'tennis_court' => 'Tennis court',
		'skate_park' => 'Skate Park',
		'offices' => 'Offices',
		'cinema_room' => 'Cinema Room',
		'gaming_room' => 'Gaming Room',
		'zoom_room' => 'Zoom Room',
		'coworking' => 'Coworking',
		'meet_model_unit' => 'Conoce nuestra unidad modelo',
		'more_for_sale' => 'Más propiedades en venta',
		'director' => 'Socio Director',
		'management' => 'Gerente de Operaciones',
		'auxiliar' => 'Auxiliar de Dirección',
		'real_estate_agent' => 'Asesor de Ventas',

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