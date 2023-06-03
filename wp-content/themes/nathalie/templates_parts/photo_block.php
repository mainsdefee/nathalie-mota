<div class="ligne">
<img  src="<?php echo get_stylesheet_directory_uri(); ?>/images/line.png" alt="Mon image">
</div>
<section class="troisieme">
  <h2>VOUS AIMEREZ AUSSI</h2>
  <div class="troisieme__images"id="troisieme_blocks">
    <?php
      // Récupérer la catégorie de l'article en cours
      $categorie = strip_tags(get_the_term_list($post->ID, 'categorie'));
      
      // Arguments de la requête pour récupérer les photos liées à la même catégorie
      $args = array(
        'post_type' => 'photo', // Type de publication à récupérer
        'post__not_in' => array($post->ID), // Exclure l'article en cours
        'posts_per_page' => 2, // Limiter le nombre de photos à afficher
        'tax_query' => array(
          array(
            'taxonomy' => 'categorie', // Taxonomie à filtrer (catégorie)
            'field' => 'slug',
            'terms' => $categorie // Valeur de la catégorie actuelle
          )
        ),
        'orderby' => 'rand' // Tri aléatoire des photos
      );
      
      // Exécuter la requête WP_Query avec les arguments spécifiés
      $related_photos = new WP_Query($args);
      
      // Vérifier si des photos liées ont été trouvées
      if ($related_photos->have_posts()) {
        while ($related_photos->have_posts()) {
          $related_photos->the_post(); ?>
          <div class="troisieme__item"id="carre">
            <a href="<?php the_permalink(); ?>">
              <figure>
                <?php the_post_thumbnail(); // Afficher l'image de la photo ?>
                <div class="troisieme__overlay"id="over">
                  <div class="troisieme__icons">
                    <a href="<?php the_post_thumbnail_url(); ?>" class="full-screen-icon"><i class="fas fa-expand"></i></a>
                    <a href="<?php the_permalink(); ?>" class="single-photo-link download-icon" data-image="<?php the_post_thumbnail_url(); ?>" data-id="<?php echo get_the_ID(); ?>"><i class="fas fa-eye eye-icon"></i></a>
                  </div>
                </div>
              </figure>
            </a>
            <h3><?php the_title(); ?></h3> <!-- Afficher le titre de la photo -->
          </div>
        <?php }
      } else {
        echo '<p class="texte">Il n\'y a pas encore d\'autres photos à afficher dans cette catégorie.</p>'; // Message affiché s'il n'y a pas de photos liées
      }
      
      // Réinitialiser la requête postdata
      wp_reset_postdata();
    ?>
  </div>
  <div class="troisieme__bouton">
    <a href="<?php echo esc_url(get_post_type_archive_link('photo')); ?>" class="bouton">Toutes les photos</a> <!-- Lien vers la page d'archives des photos -->
  </div>
</section>



