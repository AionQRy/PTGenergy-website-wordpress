<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

?>

<article id="post-<?php the_ID(); ?>" class="card-recent_post">
	<div class="post-header">
		<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
		</a>
	</div><!-- .entry-header -->

	<div class="post-info">
        <div class="title-head_card">
            <?php 
            the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
            ?>
        </div>
        <div class="date-post_card">
            <?php 	
$post_date = get_the_date( 'd F Y' ); ?>
            <span class="date-post_card">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="#0074bc" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span class="text-card"><?php echo $post_date; ?></span>
            </span>
        </div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
