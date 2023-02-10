<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-item-style_2'); ?>>
	<div class="post-header">
		<?php in_thumb(); ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="wrap-thumb">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
			</div>
		</a>
		<div class="entry-meta">
			<span class="post_date">
				<?php  $setting_theme = get_field('setting_theme', 'option'); ?>
				<?php if ($setting_theme == 'five' || $setting_theme == 'six'): ?>
					<span class="line-1">
						<?php if ($setting_theme == 'six'): ?>
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
						<?php endif; ?>
						<?php echo get_the_date('d'); ?>
					</span>
					<span class="line-2"><?php echo get_the_date('M y'); ?></span>
					<?php else: ?>
						<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
						<?php echo get_the_date('d M y'); ?>
				<?php endif; ?>
			</span>
			<div class="clearfix"></div>
		</div><!-- .entry-meta -->
	</div><!-- .entry-header -->

	<div class="post-info">
		<?php 	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );	?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
