<?php
function theme_style() {
	wp_enqueue_style( 'theme-core-2-css', get_stylesheet_directory_uri() . '/theme-core/theme-2/theme-2.css', array(), '1.1', 'all');
	wp_enqueue_script( 'theme-core-2-js', get_stylesheet_directory_uri() . '/theme-core/theme-2/js/theme-2.js', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-header-2-css', get_stylesheet_directory_uri() . '/theme-core/theme-2/css/header-2.css', array(), '1.1', 'all');
    wp_enqueue_style( 'theme-footer-2-css', get_stylesheet_directory_uri() . '/theme-core/theme-2/css/footer-2.css', array(), '1.1', 'all');
}
add_action( 'wp_enqueue_scripts', 'theme_style' , 20 );
?>
