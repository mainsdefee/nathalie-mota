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


