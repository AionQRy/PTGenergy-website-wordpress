<?php
/**
  * Search Page
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
?>

	<main id="primary" class="site-main archive-box search-page">
  <?php
  $search = 1;
  require_once('template-parts/page-title-archive-s2.php'); ?>

	<div class="detail-archive_box um-page-loggedout">
		<div class="v-container"  id="main">
			<div class="page-sub-title">
				<?php if ($_GET['_sf_s']): ?>
          <div class="left">
            <span class="result"><?php esc_html_e( 'คำค้นหา', 'fluffy' ); ?></span>
            <h3>"<?php echo $_GET['_sf_s']; ?>" </h3>
          </div>
          <div class="right">
            <div class="qty">
              <span>ผลลัพธ์การค้นหา</span>
              <strong>
                <?php global $wp_query; echo $wp_query->found_posts; ?>
              </strong>
             <?php esc_html_e( 'รายการ', 'fluffy' ); ?>
            </div>
          </div>
				<?php endif; ?>
			</div>

      <?php

      $filter = get_page_by_path( 'search-filter', OBJECT, 'search-filter-widget' );

      if ( function_exists( 'pll_the_languages' ) ) {
        $id_filter = $translations = $GLOBALS["polylang"]->model->post->get_translations($filter->ID);
        if (get_locale() == 'th') {
          $filter_id = $id_filter['th'];
        }
        if (get_locale() != 'th') {
          $filter_id = $id_filter['en'];
        }
      }
      else {
        $filter_id = $filter->ID;
      }


                echo '<div class="search-bar_ypx">';
                echo do_shortcode('[searchandfilter id="'.$filter_id.'"]');
                echo '</div>';
          ?>



			<div  id="grid-column-post" class="grid-column-post">
          <?php

          // $posts_per_page = 2;
            $args = array(
            // 'post_type' => array( 'post'),
            'orderby' => 'DESC',
            );
            $args['search_filter_id'] = $filter_id;
            $query_all = query_posts( $args );
           ?>

              <div class="main-post_column">
              <?php if ( have_posts() ) : ?>
                  <?php
                  /* Start the Loop */
                  while ( have_posts() ) :
                    the_post();
										  get_template_part( 'template-parts/content', 'card-post' );

                  endwhile;

                else :

                  get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>

                <div class="box-pageination_post">
                  <div class="count-found">
                  <h4 class="count-head"><?php yp_text( 'จำนวนทั้งหมด', 'All Posts' ); ?><span><strong><?php echo $wp_query->found_posts; ?></strong><?php yp_text( 'รายการ', 'Items' ); ?></span></h4>
                  </div>
                  <?php fluffy_posts_navigation();  ?>
                    <div class="search-bar_yp">
                        <?php echo do_shortcode('[searchandfilter id="'.$filter_id.'"]'); ?>

                    </div>
                </div>

              </div>


			</div>

		</div>
	</div>


	</main><!-- #main -->

<?php
// get_sidebar();
footer_fuc();
