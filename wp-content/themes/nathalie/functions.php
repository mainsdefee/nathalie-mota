<?php

// Action qui permet de charger des scripts dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles(){
    // Chargement du style.css du thème parent twenty twenty
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

 wp_enqueue_style( 'parent-style' , get_template_directory_uri() . '/style.css' );
 // Chargement du css/theme.css pour nos personnalisations
   wp_enqueue_style( 'theme-style' , get_stylesheet_directory_uri() . '/css/theme.css' , array (), filemtime(get_stylesheet_directory() . '/css/theme.css' ));

}
/*charger les polices Google Fonts sur notre site WordPress*/
function my_theme_enqueue_scripts() {
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono|Poppins&display=swap' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );
