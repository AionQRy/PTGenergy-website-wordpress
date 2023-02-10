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

  <?php v_page_title(); ?>
<div class="page wrap-bg">
	<div class="entry-content">
		<div class="v-container">
			<div class="page-sub-title">
				<h2><?php the_title(); ?></h2>
			</div>
						<img src="<?php echo get_template_directory_uri();?>/img/404.jpg" alt="404">
		</div>
	</div><!-- .entry-content -->
</div>
</article><!-- #post-<?php the_ID(); ?> -->
