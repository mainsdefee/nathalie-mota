
<?php

// Action qui permet de charger des scripts dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');

function theme_enqueue_styles_and_scripts(){
    // Chargement du style.css du thème parent twenty twenty
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Chargement du css/theme.css pour nos personnalisations
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css' ));

    // Chargement du script.js pour nos scripts personnalisés
    wp_enqueue_script( 'theme-script', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0', true );
}
/* Charger les polices Google Fonts sur notre site WordPress */
function ajouter_polices_google() {
    wp_enqueue_style( 'polices-google', 'https://fonts.googleapis.com/css?family=Poppins:400,500,600,700|Space+Mono:400,700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'ajouter_polices_google' );

//Ce code ajoute un lien "CONTACT" dans le menu principal avec le hook wp nav menu items//
function ajouter_lien_modale_contact($items, $args) {
    if ($args->theme_location == 'primary') {
        $items .= '<li id="menu-item-contact" class="menu-item has-modal"><a href="#">CONTACT</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'ajouter_lien_modale_contact', 10, 2);


function cptui_register_my_cpts_photo() {

	/**
	 * Post Type: photo.
	 */

	$labels = [
		"name" => esc_html__( "photo", "twentytwentyone" ),
		"singular_name" => esc_html__( "photos", "twentytwentyone" ),
	];

	$args = [
		"label" => esc_html__( "photo", "twentytwentyone" ),
		"labels" => $labels,
		"description" => "photo prises par Nathalie",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "photo", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "page-attributes" ],
		"show_in_graphql" => false,
	];

	register_post_type( "photo", $args );
}

add_action( 'init', 'cptui_register_my_cpts_photo' );
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Catégories.
	 */

	$labels = [
		"name" => esc_html__( "Catégories", "twentytwentyone" ),
		"singular_name" => esc_html__( "Catégorie", "twentytwentyone" ),
	];

	
	$args = [
		"label" => esc_html__( "Catégories", "twentytwentyone" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'categorie', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "categorie",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "categorie", [ "photo" ], $args );

	/**
	 * Taxonomy: Formats.
	 */

	$labels = [
		"name" => esc_html__( "Formats", "twentytwentyone" ),
		"singular_name" => esc_html__( "Format", "twentytwentyone" ),
	];

	
	$args = [
		"label" => esc_html__( "Formats", "twentytwentyone" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'format', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "format",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "format", [ "photo" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
function cptui_register_my_taxes_categorie() {

	/**
	 * Taxonomy: Catégories.
	 */

	$labels = [
		"name" => esc_html__( "Catégories", "twentytwentyone" ),
		"singular_name" => esc_html__( "Catégorie", "twentytwentyone" ),
	];

	
	$args = [
		"label" => esc_html__( "Catégories", "twentytwentyone" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'categorie', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "categorie",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "categorie", [ "photo" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_categorie' );
function cptui_register_my_taxes_format() {

	/**
	 * Taxonomy: Formats.
	 */

	$labels = [
		"name" => esc_html__( "Formats", "twentytwentyone" ),
		"singular_name" => esc_html__( "Format", "twentytwentyone" ),
	];

	
	$args = [
		"label" => esc_html__( "Formats", "twentytwentyone" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'format', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "format",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "format", [ "photo" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_format' );


/*'enregistrer et  charger le script "lightbox.js" dans le thème enfant WordPress*/
function enqueue_lightbox_script() {
  wp_enqueue_script( 'lightbox-script', get_stylesheet_directory_uri() . '/js/lightbox.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_lightbox_script' );


