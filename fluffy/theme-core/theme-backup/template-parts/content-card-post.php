<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

?>

<article id="post-<?php the_ID(); ?>" class="card-post_m card-recent_post wow fadeInUp card-theme-1 card-theme-4">
	<div class="post-header">
		<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
			<div class="wrap-thumb">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
				<div class="divide-obj"></div>
			</div>
		</a>

	</div><!-- .entry-header -->

	<div class="post-info">
        <div class="title-head_card_s1">
            <?php
            the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
            ?>
        </div>
					<div class="post_excerpt">
						<?php
						echo str_replace("\xc2\xa0","",get_the_excerpt());
						?>
					</div>


					<div class="entry-meta">
						<div class="yp-col-grid">
							<span class="post_date">
								<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
								<?php echo get_the_date('d M y'); ?>
							</span>
						</div>
						<div class="yp-col-grid">
						<a class="vc-view-more" href="<?php the_permalink() ?>" role="button">
							<span><?php yp_text('รายละเอียด','Details') ?></span>
							<svg xmlns=" http://www.w3.org/2000/svg" class="svg-icon" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
							</svg>
						</a>
					</div>
					</div><!-- .entry-meta -->



	</div>
<?php in_thumb(); ?>
</article>
