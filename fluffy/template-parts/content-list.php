<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<a href="<?php the_permalink(); ?>" class="hide link-all" title="<?php the_title(); ?>"></a>
	<div class="post-header">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="wrap-thumb">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
			</div>
		</a>

	</div><!-- .entry-header -->

	<div class="post-info">
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			<div class="entry-meta">
				<span class="post_date">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
					<?php echo get_the_date('d M Y'); ?>
				</span>
				<span class="post_view">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
					<?php echo do_shortcode('[vc_post_view id="'. get_the_ID().'"]'); ?>
				</span>
				<div class="clearfix"></div>
			</div><!-- .entry-meta -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
