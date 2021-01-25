<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TWD_Starter_Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php 
		// Uses the template part to display a list of Work Categories
		get_template_part( 'template-parts/work', 'categories' ); 
	?>

	<?php 
		// Uses the template part to display a random testimonial
		get_template_part( 'template-parts/sidebar', 'testimonials' ); 
	?>	

</aside><!-- #secondary -->
