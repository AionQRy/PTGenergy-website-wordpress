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
<article id="post-<?php the_ID(); ?>" class="card-post_m card-recent_post <?php if ($no_wow == '') { } else { echo 'wow fadeInUp'; } ?>">
	<a href="<?php the_permalink(); ?>" class="link-all" title="<?php the_title(); ?>"></a>
	<div class="post-header">
		<div class="term-box">
			<span><?php echo $terms[0]->name; ?></span>
		</div>
		<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
		</a>
    <?php in_thumb(); ?>
	</div><!-- .entry-header -->

	<div class="post-info">
    <?php if ($setting_theme != 'six'): ?>
      <div class="date-post_card">
          <?php
          $post_date = get_the_date( 'd M Y' ); ?>
          <span class="date-post_card">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <span class="text-card"><?php echo $post_date; ?></span>
          </span>
          <span class="post_view">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            <?php echo do_shortcode('[vc_post_view id="'. get_the_ID().'"]'); ?>
            <?php esc_html_e( 'ครั้ง', 'fluffy' ); ?>
          </span>
      </div>
    <?php endif; ?>

        <div class="title-head_card">
            <?php
            the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
            ?>
        </div>
        <?php if ($setting_theme != 'six'): ?>
          <a href="#" class="read_more">
            <?php yp_text('อ่านต่อ','Read More'); ?>
          <?php if ($setting_theme == 'four' || $setting_theme == 'five'): ?>
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="9 18 15 12 9 6"></polyline></svg>
            <?php endif; ?>
          </a>
          <?php else: ?>
            <div class="date-post_card">
                <?php
                $post_date = get_the_date( 'd M Y' ); ?>
                <span class="date-post_card">
                  <span class="text-card"><?php echo $post_date; ?></span>
                </span>
                <span class="post_view display_name">
                  <?php echo $display_name; ?>
                </span>
            </div>
        <?php endif; ?>
	</div>
</article>
