<?php
function theme_style() {
	wp_enqueue_style( 'theme-core-6-css', get_stylesheet_directory_uri() . '/theme-core/theme-6/theme-6.css', array(), '1.1', 'all');
	wp_enqueue_script( 'theme-core-6-js', get_stylesheet_directory_uri() . '/theme-core/theme-6/js/theme-6.js', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-header-6-css', get_stylesheet_directory_uri() . '/theme-core/theme-6/css/header-6.css', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-footer-6-css', get_stylesheet_directory_uri() . '/theme-core/theme-6/css/footer-6.css', array(), '1.1', 'all');
}
add_action( 'wp_enqueue_scripts', 'theme_style' , 20 );
?>
