
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
//Ce code ajoute un lien "CONTACT" dans le menu principal avec le hook wp nav menu items//
function ajouter_lien_modale_contact($items, $args) {
    if ($args->theme_location == 'primary') {
        $items .= '<li id="menu-item-contact" class="menu-item has-modal"><a href="#">CONTACT</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'ajouter_lien_modale_contact', 10, 2);



