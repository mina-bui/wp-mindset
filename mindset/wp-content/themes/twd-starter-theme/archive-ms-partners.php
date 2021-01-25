<?php
/**
 * The template for displaying the archive "Partners" page
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
		$taxonomy = 'ms-partners-category';
		$terms = get_terms(
			array(
				'taxonomy' => $taxonomy
			)
		);
		if($terms && ! is_wp_error($terms) ){
			foreach($terms as $term){
				$term_args = array(
					'post_type'      => 'ms-partners',
					'posts_per_page' => -1,
					'tax_query'      => array(
							array(
								'taxonomy' => $taxonomy,
								'field'    => 'slug',
								'terms'    => $term->slug,
							)
					),
				);
				$term_query = new WP_Query ($term_args);
				if ( $term_query->have_posts() ) {
					//display the term name dynamically
					echo '<h2>' . $term->name . '</h2>';
					echo '<ul>';
					while($term_query->have_posts()){
						$term_query->the_post();
						if (function_exists ('get_field')){
							if(get_field('partner_website_link')){
								echo '<li><a href="' . esc_url( get_field('partner_website_link') ) . '">';
								the_title();
								echo '</a></li>';
							}//end if
						}//end if
					}//end while
					echo '</ul>';
					wp_reset_postdata();
				}// end if
			}//end foreach
		}//end if
	?>
	
	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();