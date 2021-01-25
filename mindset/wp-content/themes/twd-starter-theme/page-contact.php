<?php
/**
 * The template for displaying the "Contact" page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
		?>

		<section class="contact-content">

			<?php
				// is ACF installed and activated?
				if ( function_exists( 'get_field' ) ) {
					// is at least one of the fields filled out?
					if ( get_field( 'contact_address_field' ) ) {
						the_field( 'contact_address_field' );
					}
				}
			?>

		</section><!-- .about-content -->

		<?php
			endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
