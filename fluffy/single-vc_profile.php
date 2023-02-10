<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fluffy
 */

header_fuc();
?>
<style media="screen">
.elementor-edit-area {
  margin: 20px 0;
}
</style>
<?php
// if( $_GET['action'] != 'elementor') { // Edit Mode
//
// }

if ( !\Elementor\Plugin::$instance->preview->is_preview_mode() ) {
    wp_safe_redirect(home_url('/my-profile'));
    exit();
}



while ( have_posts() ) :
the_post();
the_content();
wp_reset_postdata();
endwhile; // End of the loop.

// get_sidebar();
footer_fuc();
