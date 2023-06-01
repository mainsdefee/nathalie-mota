<?php
/**
 * template name: home 
 *
 *
 * @package WordPress
 */

get_header();
//the_post();


      // Arguments de la requête pour récupérer les photos liées à la même catégorie
      $args = array(
        'post_type' => 'photo', // Type de publication à récupérer
        'posts_per_page' => 1, // Limiter le nombre de photos à afficher
        'orderby' => 'rand' // Tri aléatoire des photos
      );
      
      // Exécuter la requête WP_Query avec les arguments spécifiés
      $photo_une = new WP_Query($args);
      $photo_une->the_post();

?>
<!-- première section  avec la photo aléatoire et le titre-->
<section class="hero">
    <h1>Photographe event</h1>
   
    <img src="<?php echo the_post_thumbnail_url(); ?>" id="photo_principale" />
</section>

