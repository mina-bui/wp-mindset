<?php
/**
 * Template part for displaying a random testimonial on the sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

?>

<?php 
    // Testimonials on About page
    $args = array(
        'post_type' 	 => 'ms-testimonial',
        'posts_per_page' => 1,
        'orderby'        => 'rand'
    );
    $query = new WP_Query( $args );
    if ( $query -> have_posts() ){
        echo '<section><h3>What They Say</h3>';
        while ( $query -> have_posts() ) {
            $query -> the_post();
            the_content();
        }
        wp_reset_postdata();
        echo '</section>';
    } 
?>