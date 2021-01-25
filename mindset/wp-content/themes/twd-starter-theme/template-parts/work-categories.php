<?php
/**
 * Template part for displaying Work Categories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

?>

<?php
    $terms = get_terms(
        array(
            'taxonomy' => 'ms-work-category'
        )
    );

    if( $terms && ! is_wp_error( $terms ) ) {
        echo '<section>';
        echo '<h3>See Our Work</h3>';
        echo '<ul>';
        foreach( $terms as $term ) {
            echo '<li>';
            echo '<a href="'. get_term_link( $term ) .'">';
            echo $term->name;
            echo ' ( '. $term->count .' ) ';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</section>';
    }

?>