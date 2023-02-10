<?php
function theme_style() {
	wp_enqueue_style( 'theme-core-5-css', get_stylesheet_directory_uri() . '/theme-core/theme-5/theme-5.css', array(), '1.1', 'all');
	wp_enqueue_script( 'theme-core-5-js', get_stylesheet_directory_uri() . '/theme-core/theme-5/js/theme-5.js', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-header-5-css', get_stylesheet_directory_uri() . '/theme-core/theme-5/css/header-5.css', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-footer-5-css', get_stylesheet_directory_uri() . '/theme-core/theme-5/css/footer-5.css', array(), '1.1', 'all');
}
add_action( 'wp_enqueue_scripts', 'theme_style' , 20 );
?>
