<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */
$url_weblink = get_field('url_link'); ?>

<article id="post-<?php the_ID(); ?>" class="card-weblink">
	<div class="post-header">
		<a href="<?php echo $url_weblink; ?>" target="_blank" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
		</a>
	</div><!-- .entry-header -->

	<div class="post-info">
        <div class="title-head_card">
            <?php
            the_title( '<h4 class="entry-title"><a href="' . esc_url( $url_weblink ) . '" rel="bookmark">', '</a></h4>' );
            ?>
        </div>
        <div class="date-post_card">

            <span class="date-post_card">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                <span class="text-card"><a target="_blank" href="<?php echo $url_weblink; ?>"><?php echo $url_weblink; ?></a></span>
            </span>
        </div>
	</div>

</article>
