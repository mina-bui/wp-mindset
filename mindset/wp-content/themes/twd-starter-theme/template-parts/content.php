<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
						twd_posted_on();
						twd_posted_by();
					?>
				</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php twd_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			// if it is a single blog post, show the full content
			if ( is_single() ) {
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twd' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				
				// is ACF installed and activated?
				if ( function_exists( 'get_field' ) ) {

					// is at least one of the fields filled out?
					if ( get_field( 'info_title' ) || get_field( 'info_content' ) || get_field( 'info_image' ) ) {
						echo '<div class="info-box">';
						if ( get_field( 'info_title' ) ) {
							echo '<h2>';
							the_field( 'info_title' );
							echo '</h2>';
						}
						if ( get_field( 'info_content' ) ) {
							the_field( 'info_content' );
						}
						if( get_field( 'info_image' ) ) {
							echo wp_get_attachment_image( get_field( 'info_image' ), 'large' );
						}
						echo '</div>';
					}
				}

			// otherwise, on the blog index, show only an excerpt
			} else {
				the_excerpt();
			}

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'twd' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php twd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
