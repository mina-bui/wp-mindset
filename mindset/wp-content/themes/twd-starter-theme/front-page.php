<?php
/**
 * The template for displaying the front page
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

			?>

			<h1><?php the_title(); ?></h1>

			<section class="home-intro">
			
				<?php
					// Load the intro section from a separate page using WP_query
					// The page+id is the ID of the about page, where we added the text

					$args = array( 'page_id' => 5 ); // list of parameters
					$intro_query = new WP_Query( $args );
					if ( $intro_query -> have_posts() ){
						while ( $intro_query -> have_posts() ) {
							$intro_query -> the_post();
							the_content();
						}
						wp_reset_postdata();
					} 
				?>

			</section><!-- .home-intro -->

			<section class="home-work">
			
				<?php 
					$args = array(
						'post_type' => 'ms-work',
						'posts_per_page' => 4,
						'tax_query' => array (
							array(
								'taxonomy'  => 'ms-featured',
								'field'		=> 'slug',
								'terms'		=> 'front-page'
							)
						)
					);
					$query = new WP_Query( $args );
					echo '<div class="break"></div>';
					echo '<h2>Featured Works</h2>';
					echo '<div class="break"></div>';

					echo '<div class="home-work-flex-box">';
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							echo '<article>';
							echo '<a href="' . get_permalink() . '">';
							the_post_thumbnail('medium');
							echo '<p>' . get_the_title() . '</p>';
							echo '</a>';
							echo '</article>';
						}
						wp_reset_postdata();
					} 
					echo '</div>';
				?>

					
				<?php
					// Add an ACF relationship field and assign it to the Home page
					echo '<div class="break"></div>';
					echo '<h2>';
					the_field( 'featured_works_title' );
					echo '</h2>';

					echo '<div class="break"></div>';

					echo '<div class="home-work-flex-box">';
					if ( function_exists( 'get_field' ) ) : 
						$featured_works = get_field('featured_works');
						if ($featured_works) :
							foreach($featured_works as $post) :
								setup_postdata($post); ?>
								<article class="front-portfolio">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium'); ?>
										<p><?php the_title(); ?></p>
									</a>
								</article>
							<?php 
							endforeach;
							wp_reset_postdata();
						endif;
					endif;
					echo '</div>';
				?>

			</section><!-- .home-work -->
			
			<section class="home-left-right-flex-box">
				<section class="home-left">

					<?php
						if ( function_exists( 'get_field' ) ) {
							if ( get_field( 'left_section_title' ) ) {
								echo '<h2>';
								the_field( 'left_section_title' );
								echo '</h2>';
							}
							if ( get_field( 'left_section_text' ) ) {
								echo '<p>';
								the_field( 'left_section_text' );
								echo '</p>';
							}
						}
					?>

				</section><!-- .home-left -->
				
				<section class="home-right">

					<?php
						if ( function_exists( 'get_field' ) ) {
							if ( get_field( 'right_section_title' ) ) {
								echo '<h2>';
								the_field( 'right_section_title' );
								echo '</h2>';
							}
							if ( get_field( 'right_section_text' ) ) {
								echo '<p>';
								the_field( 'right_section_text' );
								echo '</p>';
							}
						}
					?>

				</section><!-- .home-right -->
			</section>

			<section class="home-slider">
				<?php
					$args = array(
						'post_type'      => 'ms-testimonial',
						'posts_per_page' => -1
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ){
						echo '<section><h2>Testimonials</h2>';
						echo '<div class="slider">';
						while ( $query->have_posts() ) {
							$query->the_post();
							echo '<div class="single-testimonial">'; 
							the_content();
							echo '</div>';
						}
						echo '</div>';
						echo '</section>';
						wp_reset_postdata();
					}
				?>
			</section><!-- .home-slider -->
			
			<section class="home-blog">
				<h2>Latest Blog Posts</h2>
			
				<?php
					$args = array( 
						'post_type'      => 'post',
						'posts_per_page' => 2 
					);
					$blog_query = new WP_Query( $args );
					if ( $blog_query -> have_posts() ){
						while ( $blog_query -> have_posts() ) {
							$blog_query -> the_post();
							echo '<h3><a href="';
							the_permalink();
							echo '">';
							the_title();
							echo '</a></h3>';
						}
						wp_reset_postdata();
					} 
				?>

			</section><!-- .home-blog -->

		<?php
			endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_footer();
