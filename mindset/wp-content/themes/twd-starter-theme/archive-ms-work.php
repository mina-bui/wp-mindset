<?php
/**
 * The template for displaying the archive "Works" page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

	<?php
		$args = array(
			'post_type' 	=> 'ms-work',
			'post_per_page' => -1,
			'tax_query' 	=> array(
				array (
					'taxonomy'  => 'ms-work-category',
					'field'		=> 'slug',
					'terms'		=> 'web'
				)
			),
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<section class="work-section"><h2>Web</h2>';
			echo '<div class="work-section-type">';
			while( $query->have_posts() ) {
				$query->the_post();
				echo '<article>';
				echo '<a href="';
				the_permalink();
				echo '">';
				echo '<h3>';
				the_title();
				echo '</h3>';
				echo the_post_thumbnail('large');
				echo '</a>';
				the_excerpt();
				echo '</article>';
			}
			wp_reset_postdata();
			echo '</div>';
			echo '</section>';
		}

			$args = array(
			'post_type' 	=> 'ms-work',
			'post_per_page' => -1,
			'tax_query' 	=> array(
				array (
					'taxonomy'  => 'ms-work-category',
					'field'		=> 'slug',
					'terms'		=> 'photo'
				)
			),
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<section class="work-section"><h2>Photos</h2>';
			echo '<div class="work-section-type">';
			while( $query->have_posts() ) {
				$query->the_post();
				echo '<article class="work-item">';
				echo '<a href="';
				the_permalink();
				echo '">';
				echo '<h3>';
				the_title();
				echo '</h3>';
				echo the_post_thumbnail('large');
				echo '</a>';
				the_excerpt();
				echo '</article>';
			}
			wp_reset_postdata();
			echo '</div>';
			echo '</section>';
		} 
	?>

	</main><!-- #primary -->

<?php
get_footer();