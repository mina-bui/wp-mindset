<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TWD_Starter_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-address">
			<?php
				// show contact_address_field on all pages except the Contact page
				if ( function_exists('get_field') ) {
					if ( get_field('contact_address_field', 16) && ! is_page('contact') ) {
						echo '<div class="footer-address">';
						get_template_part( 'images/location-2' );
						the_field('contact_address_field', 16);
						echo '</div>';
					}
				}
			?>
		</div><!-- .footer-address -->
		<div class="footer-menus">
			<nav id="footer-navigation" class="footer-navigation">
    			<?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
    		</nav>
			<nav id="social-navigation" class="social-navigation">
    			<?php wp_nav_menu( array( 'theme_location' => 'social_navigation') ); ?>
    		</nav>
		</div><!-- .footer-menus -->
		<div class="site-info">
			<?php esc_html_e( 'Starter theme by ', 'twd' ); ?>
			<a href="<?php echo esc_url( __( 'https://wp.bcitwebdeveloper.ca/', 'twd' ) ); ?>">
			<?php esc_html_e( 'Jonathon Leathers. ', 'twd' ); ?>
			</a>
			<?php echo '<div class="break"></div>'; ?>
			<?php esc_html_e( 'Modified by ', 'twd' ); ?>
			<a href="<?php echo esc_url( __( 'http://mbui.bcitwebdeveloper.ca/', 'twd' ) ); ?>">
			<?php esc_html_e( 'Mina Bui.', 'twd' ); ?>
			</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<!-- Button to scroll to the top of the page --> 
<!-- https://codepen.io/jtleathers/pen/yLYejVG -->
<button id="scroll-top" class="scroll-top">
	<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24">
		<path d="M23.677 18.52c.914 1.523-.183 3.472-1.967 3.472h-19.414c-1.784 0-2.881-1.949-1.967-3.472l9.709-16.18c.891-1.483 3.041-1.48 3.93 0l9.709 16.18z"/>
	</svg>
	<span class="screen-reader-text">Scroll To Top</span>
</button>

<?php wp_footer(); ?>

</body>
</html>
