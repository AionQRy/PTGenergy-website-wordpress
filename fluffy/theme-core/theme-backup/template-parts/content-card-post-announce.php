<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

?>
<div class="procurement-archive style-3 v-post-loop -list">
  <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <div class="post-header">
      <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
        <img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/theme-core/theme-3/img/icon-procurement.png" alt="icon-procurement">
      </a>
    </div><!-- .entry-header -->

    <div class="post-info">
      <?php
      the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

      if ( 'post' === get_post_type() ) :
        ?>
        <div class="entry-meta">
          <span class="post_date">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <?php echo get_the_date(); ?>
          </span>
          <span class="post_view">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            <?php echo do_shortcode('[vc_post_view id="'. get_the_ID().'"]'); ?>
            <?php if (get_locale() == 'th'): ?>
              <?php echo 'ครั้ง'; ?>
              <?php else: ?>
              <?php echo 'Views'; ?>
            <?php endif; ?>
          </span>
          <div class="clearfix"></div>
        </div><!-- .entry-meta -->
      <?php endif; ?>


    </div>

  </article><!-- #post-<?php the_ID(); ?> -->
</div>
