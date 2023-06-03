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

<!-- deuxième section Mettre en place les selects pour permettre de filtrer et trier les photos -->
<!--Remplir dynamiquement en récupérant les termes de taxonomies ou des custom fields concernés-->

<section class="galerie bloc-page"id="font">
    <div class="filtres colonnes">
        <div class="filtres__taxonomie">
            <form id="categories" class="js-filter-form filtres__taxonomie_categories filtre colonne">
                <label for="select-categorie">CATEGORIES</label>
                <select id="select-categorie" name="categorie">
                    <option value="all" hidden></option>
                    <option value="all">Toutes les catégories</option>
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'categorie',
                        'hide_empty' => false,
                    ));

                    foreach ($terms as $term) {
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                    }
                    ?>
                </select>
            </form>
        </div>
        <div class="filtres__formats">
            <form id="format" class="js-filter-form filtres_taxonomie__formats filtre colonne">
                <label for="select-format">FORMATS</label>
                <select id="select-format" name="format">
                    <option value="all" hidden></option>
                    <option value="all">Tous les formats</option>
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'format',
                        'hide_empty' => false,
                    ));

                    foreach ($terms as $term) {
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                    }
                    ?>
                </select>
            </form>
        </div>
        <div class="filtres__tri colonnes colonne">
            <div class="colonne"></div>
            <form id="ordre" class="js-filter-form filtres_taxonomie__formats filtre colonne">
                <label for="select-ordre">TRIER PAR</label>
                <select id="select-ordre">
                    <option class="js-ordre-item" value="DESC" selected>Nouveautés</option>
                    <option class="js-ordre-item" value="ASC">Les plus anciens</option>
                </select>
            </form>
        </div>
    </div>
</section>
<!--Liste des photos / afficher grâce à une loop sur le type de contenu personnalisé-->
<!--Réutiliser le bloc d’affichage d’une photo de la liste dans photo-block.php-->
<!--intégrer une pagination infinie en Ajax en s'appuyant sur l’API de WordPress-->
<section class="troisieme"id="bordure">
  
  <div class="troisieme__images"id="troisieme_blocks">
    <?php
    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 8, // Afficher les 8 premières photos
      'orderby' => 'rand' // Tri aléatoire des photos
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      $count = 0; // Compteur pour suivre le nombre de photos affichées
      while ($query->have_posts()) {
        $query->the_post(); ?>
        <div class="troisieme__item"id="carre">
          <a href="<?php the_permalink(); ?>">
            <figure>
              <?php the_post_thumbnail(); ?>
              <div class="troisieme__overlay">
                <div class="troisieme__icons">
                  <a href="<?php the_post_thumbnail_url(); ?>" class="full-screen-icon"><i class="fas fa-expand"></i></a>
                  <a href="<?php the_permalink(); ?>" class="single-photo-link download-icon" data-image="<?php the_post_thumbnail_url(); ?>" data-id="<?php echo get_the_ID(); ?>"><i class="fas fa-eye eye-icon"></i></a>
                </div>
              </div>
            </figure>
          </a>
          <h3><?php the_title(); ?></h3>
        </div>
        <?php
        $count++;
        if ($count == 8) {
          break; // Sortir de la boucle après avoir affiché les 8 premières photos
        }
      }
    } else {
      echo '<p class="texte">Il n\'y a pas encore de photos à afficher.</p>';
    }

    wp_reset_postdata();
    ?>
  </div>
  <div class="troisieme__bouton">
    <button id="btn-charger-plus" class="bouton">Charger plus</button>
  </div>
</section>

<script>
jQuery(document).ready(function($) {
  var offset = 8; // Offset initial des photos à charger
  var perPage = 8; // Nombre de photos à charger à chaque requête
  var btnChargerPlus = $('#btn-charger-plus');

  btnChargerPlus.on('click', function() {
    var button = $(this);

    $.ajax({
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      type: 'POST',
      data: {
        action: 'charger_plus_photos',
        offset: offset,
        perPage: perPage
      },
      beforeSend: function() {
        button.attr('disabled', 'disabled').text('Chargement en cours...');
      },
      success: function(response) {
        if (response.success) {
          var photos = response.data;

          if (photos.length > 0) {
            var imagesContainer = $('.troisieme__images');

            $.each(photos, function(index, photo) {
              var item = '<div class="troisieme__item"id="carre">' +
                '<a href="' + photo.permalink + '">' +
                '<figure>' +
                '<img src="' + photo.thumbnail + '" alt="' + photo.title + '">' +
                '<div class="troisieme__overlay">' +
                '<div class="troisieme__icons">' +
                '<a href="' + photo.fullscreenUrl + '" class="full-screen-icon"><i class="fas fa-expand"></i></a>' +
                '<a href="' + photo.permalink + '" class="single-photo-link download-icon" data-image="' + photo.thumbnail + '" data-id="' + photo.id + '"><i class="fas fa-eye eye-icon"></i></a>' +
                '</div>' +
                '</div>' +
                '</figure>' +
                '</a>' +
                '<h3>' + photo.title + '</h3>' +
                '</div>';

              imagesContainer.append(item);
            });

            offset += perPage; // Mettre à jour l'offset pour la prochaine requête

            // Vérifier si toutes les photos ont été chargées
            if (offset >= 16) {
             
              
            }
          }
        }
      },
      complete: function() {
        button.removeAttr('disabled').text('Charger plus');
      }
    });
  });
});
</script>






<?php get_footer() ?>

