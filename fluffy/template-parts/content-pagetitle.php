<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (!is_front_page() ): ?>
  <?php v_page_title(); ?>
	<?php endif; ?>
<div class="page wrap-bg<?php if ( is_elementor() ) { echo 'e'; } ?>">
	<div class="entry-content">
		<div class="v-container">
			<div class="page-sub-title">
				<h2><?php the_title(); ?></h2>
			</div>
			<?php
			the_content();
			?>
		</div>
	</div><!-- .entry-content -->
</div>
</article><!-- #post-<?php the_ID(); ?> -->
