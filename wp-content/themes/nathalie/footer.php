<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>


			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

	<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>

	<footer id="colophon" class="site-footer">

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul class="footer-navigation-wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->
		<?php endif; ?>
		
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<!--inclure le modèle modale-contact.php-->
<?php get_template_part('templates/modal', 'contact'); ?>

<?php wp_footer(); ?>

<div class="lightbox">
    <button class="lightbox__close"><i class="fas fa-times"></i></button>
    <div class="lightbox__overlay"></div>
    <div class="lightbox__container">
        <img src="" alt="">
    </div>
</div>

<script src="https://kit.fontawesome.com/143327980b.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function openLightbox(imageUrl) {
            const lightbox = document.querySelector(".lightbox");
            const lightboxImage = lightbox.querySelector(".lightbox__container img");

            lightboxImage.src = imageUrl;
            lightbox.style.display = "flex";
        }

        function closeLightbox() {
            const lightbox = document.querySelector(".lightbox");
            lightbox.style.display = "none";
        }

        // Gestionnaire d'événement pour le bouton de fermeture
        const closeIcon = document.querySelector(".lightbox__close");
        closeIcon.addEventListener("click", function () {
            closeLightbox();
        });

        // Gestionnaires d'événements pour les icônes plein écran
        const fullscreenIcons = document.querySelectorAll(".full-screen-icon");
        fullscreenIcons.forEach(function (icon) {
            icon.addEventListener("click", function (e) {
                e.preventDefault();
                const imageUrl = this.getAttribute("href");
                openLightbox(imageUrl);
            });
        });
    });
</script>

<script src="lightbox.js"></script>





</body>
</html>
