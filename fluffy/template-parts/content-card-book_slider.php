<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

?>
<article id="post-<?php the_ID(); ?>" class="card-book_slider <?php if ($no_wow == '') { } else { echo 'wow fadeInUp'; } ?>">
	<div class="post-header">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
		</a>
	</div><!-- .entry-header -->

	<div class="post-info">
        <div class="title-head_card">
            <?php
            the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
            ?>
        </div>
	</div>
</article>
