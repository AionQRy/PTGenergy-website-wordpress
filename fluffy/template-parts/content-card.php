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
	<div class="post-header">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
		</a>
	</div><!-- .entry-header -->

	<div class="post-info">
		<?php
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'fluffy' ) );
			if ( $categories_list ) {
				echo '<span class="cat-links _heading">';

				echo ' ' . $categories_list;
				echo '</span>';
			}
		}
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				fluffy_posted_on();
				fluffy_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<div class="entry-summary">
				<?php the_excerpt();?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
