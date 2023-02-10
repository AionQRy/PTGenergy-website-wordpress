<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */
$gallery = get_field('gallery_post' );
?>

<article id="post-<?php the_ID(); ?>" class="card-recent_gallery">
    <div class="feature-thumbnail">
        <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
				<?php if(has_post_thumbnail()) { the_post_thumbnail();} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
            </a>
    </div>
	<?php
							$images = get_field( 'gallery_post' );
                            $size = 'medium'; // (thumbnail, medium, large, full or custom size)
                            if ( $images ) {							
                                $counter = 1;
                                $count_gallery = count($images)-3;
                            ?>
                            <div class="gallery-thumbnail <?php if($count_gallery < 3){ echo 'two-col_gallery'; }?>">
                            <div class="product-gallery">
                                <?php
                                foreach( $images as $image ) {
                                ?>
                                <div class="image-gallery_recent">
                                    <?php echo wp_get_attachment_image( $image['ID'], $size );?>
                                    <?php if ($counter == 3 && $count_gallery > 3): ?>
										<div class="overlay_thumb">
											<div class="in-overlay">
												<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
												<span>+<?php echo $count_gallery; ?></span>
										    </div>
										</div>
									<?php endif; ?>
                                </div>
                                <?php 
                                    $counter++;
                                    if ($counter > 3) {
                                        break;
                                    }
                                }
                                ?>
                            </div>
                            </div>
                            <?php
                            }
                                    ?>
    <div class="detail-card">
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
