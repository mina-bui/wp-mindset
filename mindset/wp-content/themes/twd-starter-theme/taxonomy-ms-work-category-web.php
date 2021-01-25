<?php
/**
 * The template for displaying Work Category of Web archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1><?php single_term_title(); ?></h1>
			</header><!-- .page-header -->

		<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				
				echo '<article>';
				echo '<a href="' . get_permalink() . '">';
				echo '<h2>' . get_the_title() . '</h2>';
				the_post_thumbnail( 'thumbnail', array( 'class' => 'alignright' ) );
				echo '</a>';
				the_excerpt();
				echo '</article>';

			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
