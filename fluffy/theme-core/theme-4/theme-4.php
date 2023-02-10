<?php
function theme_style() {
	wp_enqueue_style( 'theme-core-4-css', get_stylesheet_directory_uri() . '/theme-core/theme-4/theme-4.css', array(), '1.1', 'all');
	wp_enqueue_script( 'theme-core-4-js', get_stylesheet_directory_uri() . '/theme-core/theme-4/js/theme-4.js', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-header-4-css', get_stylesheet_directory_uri() . '/theme-core/theme-4/css/header-4.css', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-footer-4-css', get_stylesheet_directory_uri() . '/theme-core/theme-4/css/footer-4.css', array(), '1.1', 'all');
}
add_action( 'wp_enqueue_scripts', 'theme_style' , 20 );
?>
