<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();


/**************************CODE PERSO */

?>
<section>
<div class="container single-photo-content">
  <div class="left-block">
	<br> <!-- Afficher le titre de la photo -->
    <h1 class="titrephoto"><?php the_title() ?></h1>
	<br>

    <p>Réf. photo :<?php the_field('reference') ?></p><!-- Afficher la référence de la photo en utilisant un champ personnalisé -->
    <p>Catégorie : <?php the_terms( get_the_ID() , 'categorie' ); ?></p> <!-- Afficher la catégorie de la photo en utilisant la taxonomie personnalisée 'categorie' -->
    <p>Format :<?php the_terms( get_the_ID() , 'format' ); ?></p> <!-- Afficher le format de la photo en utilisant la taxonomie personnalisée 'format' --> 
    <p>Type : <?php echo get_field('type'); ?></p><!-- Afficher le type de la photo en utilisant un champ personnalisé -->
    <p>Année : <?php echo get_field('annee'); ?></p> <!-- Afficher l'année de la photo en utilisant un champ personnalisé -->

  </div>
  

<div class="right-block">
  <img src="<?php the_post_thumbnail_url(); ?>">
  <!-- Afficher l'image à la une de l'article -->
  
  <div class="overlay" id="fullscreen-overlay">
    <a href="<?php the_post_thumbnail_url(); ?>" class="full-screen-icon"><i class="fas fa-expand"></i></a>
    <!-- Ajouter un lien pour afficher l'image en plein écran -->
    
    
     <a href="<?php the_permalink(); ?>" class="single-photo-link download-icon" data-image="<?php the_post_thumbnail_url(); ?>" data-id="<?php echo get_the_ID(); ?>"><i class="fas fa-eye eye-icon"></i></a>
    <!-- Ajouter un lien pour télécharger l'image -->
  </div>
</div>


 
</div>
<div class="deuxieme">
  <div class="bottom-block">
    <p>Cette photo vous intéresse ?</p>
    <img class="trait" src="<?php echo get_stylesheet_directory_uri(); ?>/images/22.png" alt="Mon image">
    <!-- Afficher une image avec le chemin spécifié -->
    
    <a href="#" class="contact-photo-link" data-toggle="modal" data-target="#modal-contact-photo">Contact</a>
    <!-- Création d'un lien pour afficher une fenêtre modale de contact -->
    
    <div class="modal-wrapper" id="modal-contact-photo">
      <div class="modal">
        <span class="modal-close-photo">&times;</span>
        <h2>Contactez-nous pour <br>cette photo</h2>
        <?php echo do_shortcode('[wpforms id="137" title="false" description="false" ajax="true"]'); ?>
        <!-- Afficher un formulaire de contact à l'aide du plugin WPForms avec l'ID spécifié -->
      </div>
    </div>
  <!--: Ces lignes de code permettent d'afficher les liens vers les photos précédentes et suivantes, ainsi que leurs images miniatures.-->
    <?php
    $prevPost = get_previous_post();
    $nextPost = get_next_post();
    ?>

    <div class="minione">
  <?php if (!empty($prevPost)) { // Vérifie si la photo précédente existe
    $prevThumbnail = get_the_post_thumbnail_url($prevPost->ID); // Récupère l'URL de l'image miniature de la photo précédente
    $prevLink = get_permalink($prevPost); // Récupère le lien vers la photo précédente
  ?>
    <div class="prev-linkg">
      <img class="previous-image" src="<?php echo $prevThumbnail; ?>" alt="Prévisualisation image précédente"> <!-- Affiche l'image miniature de la photo précédente -->
    </div>
    <a href="<?php echo $prevLink; ?>" class="flechegauche">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/7.png" alt="Flèche pointant vers la gauche"> <!-- Affiche une flèche pointant vers la gauche -->
    </a>
  <?php } ?>
</div>


    <div class="minideux">
  <?php if (!empty($nextPost)) { // Vérifie si la photo suivante existe
    $nextThumbnail = get_the_post_thumbnail_url($nextPost->ID); // Récupère l'URL de l'image miniature de la photo suivante
    $nextLink = get_permalink($nextPost); // Récupère le lien vers la photo suivante
  ?>
    <div class="prev-linkd">
      <img src="<?php echo $nextThumbnail; ?>" alt="Prévisualisation image suivante"> <!-- Affiche l'image miniature de la photo suivante -->
    </div>
    <a href="<?php echo $nextLink; ?>" class="flechedroite">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/6.png" alt="Flèche pointant vers la droite"> <!-- Affiche une flèche pointant vers la droite -->
    </a>
  <?php } ?>
</div>

  </div>
</div>

</section>
<section>
 <?php get_template_part( 'templates_parts/photo_block' ); ?>
</section>

<?php
/********************************FIN CODE PERSO */


/* ce code vérifie si la page est une pièce jointe, affiche la navigation vers les photos précédentes et suivantes*/
if (is_attachment()) {
  // Vérifie si la page actuelle est une pièce jointe (attachment)
  

  // Navigation vers la photo parente
  the_post_navigation(
    array(
      /* traducteurs : %s représente le lien vers la photo parente */
      'prev_text' => sprintf(__('<span class="meta-nav">Publié dans</span><span class="post-title">%s</span>', 'twentytwentyone'), '%title'),
    )
  );
}

// Vérifie si les commentaires sont ouverts pour la photo ou s'il y a au moins un commentaire existant.
if (comments_open() || get_comments_number()) {
  // Charge le template des commentaires de la photo
  comments_template();
}

// Fin de la boucle principale (loop) pou la photo actuelle
endwhile;
?>


<?php get_footer(); ?>

<!-- Adapter la modale du formulaire sur le lien contact -->
<script>
  // Ouvrir la modale au clic sur le lien "Contact"
  jQuery(".contact-photo-link").on("click", function (e) {
    e.preventDefault();
    jQuery("#modal-contact-photo").fadeIn();
  });

  // Fermer la modale au clic sur le bouton de fermeture
  jQuery(".modal-close-photo").on("click", function () {
    jQuery("#modal-contact-photo").fadeOut();
  });

  // Fermer la modale au clic en dehors de celle-ci
  jQuery(document).on("click", function (e) {
    if (e.target == document.querySelector("#modal-contact-photo")) {
      jQuery("#modal-contact-photo").fadeOut();
    }
  });
//ouvre la modale de contact avec le champ “Réf. Photo” prérempli avec l identifiant de la photo courante //
 jQuery("#wpforms-137-field_3").val("Réf. photo: <?php echo get_field('reference'); ?>");





</script>
