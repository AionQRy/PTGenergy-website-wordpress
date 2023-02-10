<article id="post-<?php the_ID(); ?>" class="card-box_course <?php if ($no_wow == '') { } else { echo 'wow fadeInUp'; } ?>">
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
                    <div class="btn-box_hot">
                      <a href="<?php echo get_permalink(); ?>"> <?php esc_html_e( 'Read More', 'fluffy' ); ?><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                    </div>
              </div>
            </article>