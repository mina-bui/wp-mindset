<?php
/**
 * The template for displaying the "About" page
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

		<section class="about-content">

			<?php
				// is ACF installed and activated?
				if ( function_exists( 'get_field' ) ) {
					// note: about_info_image must be above about_info_content for content to wrap around image.
					// Display the medium size image with a return value of ID
					$about_info_image_id = get_field( 'about_info_image' );
					if( get_field( 'about_info_image' ) ) {
						echo wp_get_attachment_image( $about_info_image_id, 'medium', '', array( 'class' => 'alignleft' ) );
					}
					// show the content of the WYSIWYG editor with the Basic toolbar
					if ( get_field( 'about_info_content' ) ) {
						the_field( 'about_info_content' );
					}
				}
			?>

		</section><!-- .about-content -->

		<?php 
			// Testimonials on About page
			$args = array(
				'post_type' 	 => 'ms-testimonial',
				'posts_per_page' => -1
			);
			$query = new WP_Query( $args );
			if ( $query -> have_posts() ){
				echo '<section"><h2>Testimonials</h2>';
				while ( $query -> have_posts() ) {
					$query -> the_post();
					the_content();
				}
				wp_reset_postdata();
				echo '</section>';
			} 
		?>

		<?php
			endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_footer();
