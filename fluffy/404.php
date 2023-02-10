<?php
/**
 * The template for displaying 404
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

header_fuc();
?>

	<main id="primary" class="site-main">

			<?php
					get_template_part( 'template-parts/content', '404' );
			?>



	</main><!-- #main -->

<?php
// get_sidebar();
footer_fuc();
