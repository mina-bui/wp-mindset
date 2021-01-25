<?php
/**
 * The template for displaying the "Our Services" page
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

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						echo '<div class="services-anchor-navigation">';

						$args = array(
							'post_type' 	 => 'ms-service',
							'posts_per_page' => -1,
							'order' 		 => 'ASC',
							'orderby' 		 => 'title'
							);
						$query = new WP_Query( $args );
						if ( $query -> have_posts() ){
							// get_the_id() => retrieves the unique ID of the current item in the loop
							while ( $query -> have_posts() ) {
								$query -> the_post();
								echo '<a href="#' . get_the_id() . '">';
								the_title();
								echo '</a> ';
							}
							
							echo '</div>';

							while ( $query -> have_posts() ) {
								$query -> the_post();
								echo '<h2 id="' . get_the_id() . '">';
								the_title();
								echo '</h2>';
								the_content();
							}
							wp_reset_postdata();
						}
					?>
				</div>

			</article>

		<?php endwhile; ?>
		
		
		<?php 
			// Uses the template part to display a list of Work Categories
			get_template_part( 'template-parts/work', 'categories' ); 
		?>

	</main>

<?php
get_sidebar();
get_footer();
