<div class="yp_breadcrumb">
  <div class="v-container">
    <?php
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
      }
     ?>
  </div>
</div>
<div class="post_title">
  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
</div>
<div class="single-meta">
  <div class="left-items">
    <div class="post_by">
      <i class="flaticon-account"></i>
      <?php
      $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x( '%s', 'post author', 'fluffy' ),
        '<span class="author vcard">' . esc_html( get_the_author() ) . '</span>'
      );
      echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
       ?>
       <div class="clearfix"></div>
    </div>

    <div class="post_date">
      <div class="icon-date">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
      </div>
      <?php fluffy_posted_on_onlytext(); ?>
    </div>
  </div>
  <div class="right-items">
    <div class="post_views">
      <div class="icon-view">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
      </div>
      <?php echo do_shortcode('[vc_post_view id="'. get_the_ID().'"]'); ?>
    </div>
  </div>
  <div class="clearfix"></div>

</div>
