<?php
function theme_style() {
	wp_enqueue_style( 'theme-core-3-css', get_stylesheet_directory_uri() . '/theme-core/theme-3/theme-3.css', array(), '1.1', 'all');
	wp_enqueue_script( 'theme-core-3-js', get_stylesheet_directory_uri() . '/theme-core/theme-3/js/theme-3.js', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-header-3-css', get_stylesheet_directory_uri() . '/theme-core/theme-3/css/header-3.css', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-footer-3-css', get_stylesheet_directory_uri() . '/theme-core/theme-3/css/footer-3.css', array(), '1.1', 'all');
}
add_action( 'wp_enqueue_scripts', 'theme_style' , 20 );
?>
