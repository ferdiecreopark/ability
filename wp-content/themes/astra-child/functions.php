<?php
/**
 * Ability Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ability
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ABILITY_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'ability-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ABILITY_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      	'what-we-do-1' => __( 'What We Do Menu 1' ),
		'what-we-do-2' => __( 'What We Do Menu 2' ),
		'what-we-do-3' => __( 'What We Do Menu 3' ),
		'insights-1' => __( 'Insights Menu 1' ),
		'insights-2' => __( 'Insights Menu 2' ),
		'insights-3' => __( 'Insights Menu 3' ),
      	'sustainability-1' => __( 'Sustainability Menu 1' ),
		'sustainability-2' => __( 'Sustainability Menu 2' ),
		'sustainability-3' => __( 'Sustainability Menu 3' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );


function featured_posts_megamenu($atts, $content = null) {
   extract(shortcode_atts(array(
      'posts' => 1,
   ), $atts));

   $return_string = '<div class="container-fluid pt-4">';
   $return_string .= '<div class="row">';
   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts));
   if (have_posts()) :
      while (have_posts()) : the_post();
	
		if ( has_post_thumbnail() ) {
        	$featured = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        }
	
		 $return_string .= '<div class="col-lg-4 col-md-4 col-sm-12 col-12 p-0"><a href="'.get_permalink().'"><img class="object-fit-featured-megamenu" src="'.$featured[0].'"></a></div>';
         $return_string .= '<div class="col-lg-8 col-md-8 col-sm-12 col-12"><h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5><p class="gray mt-2">'.get_the_excerpt().'</p></div>';
      endwhile;
   endif;
   $return_string .= '</div>';
   $return_string .= '</div>';

   wp_reset_query();
   return $return_string;
}
add_shortcode('featured-posts-megamenu', 'featured_posts_megamenu');
