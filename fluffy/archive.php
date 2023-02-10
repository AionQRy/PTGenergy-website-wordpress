<?php
/**
 * The template for displaying all single posts
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
 $post_type = get_post_type( get_the_ID() );


$taxonomy = 'category';
$tags = 'post_tag';
?>
<link rel='stylesheet' id='vc-fontawesome-solid' href='<?php echo site_url(); ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css' media='all' />
<link rel='stylesheet' id='vc-fontawesome' href='<?php echo site_url(); ?>/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css' media='all' />
	<main id="primary" class="site-main archive-box">

  <?php v_page_title(); ?>


	<div class="detail-archive_box">
		<div class="v-container">

			<div  id="grid-column-post" class="grid-column-post">
        <!-- <div class="left-content"> -->
          <?php


          $filter = get_page_by_path( 'post-filter', OBJECT, 'search-filter-widget' );

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
           <div class="column-post_grid">
            <div class="box-post_grid">
              <div id="main" class="main-post_column full-width <?php if ($setting_type == 'announce') { echo "one-column"; } ?>">
              <?php if ( have_posts() ) : ?>
                  <?php
                  /* Start the Loop */
                  while ( have_posts() ) :
                    the_post();
                    /*
                    * Include the Post-Type-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                    */
                    // get_template_part( 'template-parts/content', get_post_type() );
                    if ($setting_type == 'announce') {
                      get_template_part( 'template-parts/content', 'announce');
                    }
                    else if( $setting_type == '' ){
                    get_template_part( 'template-parts/content', 'card-post');
                    }
                    else {
                    get_template_part( 'template-parts/content', 'card-post');
                    }

                  endwhile;

                else :

                  get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>
                <div class="box-pageination_post">
                  <div class="count-found">
                  <h4 class="count-head"><?php yp_text( 'จำนวนทั้งหมด', 'All Posts' ); ?><span><strong><?php global $wp_query; echo $wp_query->found_posts; ?></strong><?php yp_text( 'รายการ', 'Items' ); ?></span></h4>
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
		</div>
	</div>


	</main><!-- #main -->

<?php
// get_sidebar();
footer_fuc();
