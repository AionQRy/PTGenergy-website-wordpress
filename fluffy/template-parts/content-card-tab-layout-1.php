<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */
 $setting_theme = get_field('setting_theme', 'option');
 $terms = get_the_terms( $post->ID, 'category' );
 $author_id = get_post_field ('post_author', $post_id);
 $display_name = get_the_author_meta( 'display_name' , $author_id );
?>
<article id="post-<?php the_ID(); ?>" class="content-cat_card <?php if ($no_wow == '') { } else { echo 'wow fadeInUp'; } ?>">
	<div class="post-header">
		<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
		</a>
    <?php in_thumb(); ?>
	</div><!-- .entry-header -->

	<div class="post-info">

        <div class="title-head_card">
            <?php
            the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
            ?>
        </div>
		<div class="term-box">
			<span><?php echo $terms[0]->name; ?></span>
		</div>
	</div>
</article>
