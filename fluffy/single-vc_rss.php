<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fluffy
 */

header_fuc();
global $post;

 $current_term = get_queried_object()->term_id;

 $setting_type = get_field( 'setting_type' , 'term_' . $current_term);
 $setting_theme = get_field('setting_theme', 'option');
// $post_type = 'weblink';
// $taxonomy = 'weblink_category';
?>

	<main id="primary" class="site-main archive-box downloads-box">
		<header class="entry-header">
			<div class="wrap-thumb-header ">

			<?php
			$primary_term_id = yoast_get_primary_term_id( $taxonomy, get_the_ID() );
			$author_id = $post->post_author;
		    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
			if ($featured_img_url):
				 ?>
					<div class="in-thumb" style="background-image:url('<?php echo $featured_img_url; ?>')">
					<div class="v-container">
						<?php
							the_title( '<h3 class="byline">', '</h3>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						 ?>
					</div>
				</div>
				<?php else: ?>
		    <div class="in-thumb" style="background-image:url('/wp-content/themes/fluffy/img/default-cat.jpg');">
						<div class="v-container">
							<?php the_title( '<h3 class="byline">', '</h3>' );	 ?>
						</div>
					</div>
			<?php endif; ?>

			<div class="yp_breadcrumb">
				<div class="v-container">
					<?php
						if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
						}
					 ?>
				</div>
			</div>

		</div>
	</header><!-- .entry-header -->
	<div class="detail-archive_box">
		<div class="v-container">

			<div  id="grid-column-post" class="grid-column-post">
        <!-- <div class="left-content"> -->
          <?php


           ?>
           <div class="column-post_grid full-width">
            <div class="box-post_grid">
              <div id="main">
                <div class="main-post_column col-1 rss-page-single v-post-loop -list">

                  <?php
                    $rss = simplexml_load_file(get_field('rss_url'));
                    if ($rss->channel) {

                    foreach ($rss->channel->item as $item){

                      if ($item->img) {
                        $img = $item->img;
                      }
                      if ($item->enclosure) {
                        $img = $item->enclosure['url'];
                      }
                    ?>

                <article class="post-item vc_rss type-vc_rss">
                  <div class="post-header">
                    <a href="<?php echo $item->link; ?>" target="_blank" title="<?php echo $item->title; ?>" rel="bookmark">
                      <div class="wrap-thumb">
                        <img src="<?php echo $img; ?>" alt="<?php echo $item->title; ?>">
                      </div>
                    </a>
                  </div><!-- .entry-header -->

                  <div class="post-info">
                    <h3 class="entry-title">
                      <a href="<?php echo $item->link; ?>" target="_blank" rel="bookmark">
                      <?php echo $item->title; ?>
                      </a>
                    </h3>
                    <div class="p_excerpt">
                      <?php echo $item->description; ?>
                    </div>
                  </div>
                </article>

                <?php } ?>

              <?php
                  }
                  else {
                    ?>

                    <?php
                     foreach ($rss->list->item as $item){
                       if ($item->img) {
                         $img = $item->img;
                       }
                       if ($item->enclosure) {
                        $img = $item->enclosure['url'];
                       }
                       ?>
                    <article class="post-item vc_rss type-vc_rss status-publish hentry">
                      <div class="post-header">
                        <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" target="_blank" rel="bookmark">
                          <div class="wrap-thumb">
                            <img src="<?php echo $img; ?>" alt="<?php echo $item->title; ?>">
                          </div>
                        </a>
                      </div><!-- .entry-header -->

                      <div class="post-info">
                        <h3 class="entry-title">
                          <a href="<?php echo $item->link; ?>" target="_blank" rel="bookmark">
                          <?php echo $item->title; ?>
                          </a>
                      </h3>
                        <div class="p_excerpt">
                          <?php echo $item->description; ?>
                        </div>
                      </div>
                    </article>
                  <?php } ?>


              <?php } ?>

              </div>
             </div>

            </div>
            </div>
        <!-- </div> -->
        <!-- <div class="right-content"> -->
        <!-- </div> -->
        <!-- <div class="clearfix"></div> -->
			</div>
		</div>
	</div>


	</main><!-- #main -->

<?php
// get_sidebar();
footer_fuc();
