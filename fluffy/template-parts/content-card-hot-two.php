<article id="post-<?php the_ID(); ?>" class="card-box_post <?php if ($no_wow == '') { } else { echo 'wow fadeInUp'; } ?>">
  <a href="<?php the_permalink(); ?>" class="link-all" title="<?php the_title(); ?>"></a>
              <div class="post-header">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
                </a>
              </div><!-- .entry-header -->

              <div class="post-info">
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
                    <div class="title-head_card">
                        <?php
                        the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
                        ?>
                    </div>
                    <div class="btn-box_hot">
                      <a href="<?php echo get_permalink(); ?>"> <?php esc_html_e( 'อ่านต่อ', 'fluffy' ); ?><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                    </div>
              </div>
            </article>
