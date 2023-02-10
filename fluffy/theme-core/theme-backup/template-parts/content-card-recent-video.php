<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */
$video_time = get_field('time-video');
?>

<article id="post-<?php the_ID(); ?>" class="card-recent_post card-recent_image card-recent_video">
	<div class="post-header">
		<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
        <div class="box-image_overlay">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><polygon points="10 8 16 12 10 16 10 8"></polygon></svg>
        </div>
        <div class="count-image_box">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <span><?php if($video_time == 0) { echo '00:00';}else{echo $video_time;}?></span>
        </div>
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
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <span class="text-card"><?php echo $post_date; ?></span>
            </span>
            <span class="post_view">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        <?php echo do_shortcode('[vc_post_view id="'. get_the_ID().'"]'); ?>
                        <?php esc_html_e( 'ครั้ง', 'fluffy' ); ?>
                      </span>
        </div>
	</div>

</article>
