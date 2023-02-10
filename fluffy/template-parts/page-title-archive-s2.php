<header class="two_page_title">
  <div class="wrap-page">

  <?php

  $get_post_type = get_post_type();


  // featured image
  if ($post_type == 'e-book') {
  		$taxonomy = 'ebook_category';
  		$tags = 'ebook_tags';
  }
  else {
  	$taxonomy = 'category';
  	$tags = 'post_tag';
  }

  if ( is_page() ) {
      $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
  }
  else {
        $featured_img_url = '/wp-content/themes/fluffy/img/default-cat.jpg';
  }

  if (is_singular('post')) {
    $terms = get_the_terms(get_the_ID(), $taxonomy);
    if ( $terms ) {
      end( $terms );
      $term = current( $terms );
      $title_name = $term->name;
    }

    foreach ($terms as $term) {
      if ($term->parent == 0) {
        $featured_img_id = $term->term_id;
      }
    }

    $featured_img_url = get_field('banner_image_cat','term_'.$featured_img_id);

  }
    $queried_object = get_queried_object();
    $get_tax = $queried_object->taxonomy;

if (is_post_type_archive('post') || $get_tax == 'category') {
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;
    $excerpt_category = get_field('excerpt_category', 'category_' . $term_id  );
    $featured_img_url = get_field('banner_image_cat','category_'.$term_id);

    $featured_img_url = $featured_img_url['url'];
  }
 if (is_post_type_archive('e-book') || $get_tax == 'ebook_category') {
    $featured_img_url = '/wp-content/themes/fluffy/img/default-cat.jpg';
  }
if (is_post_type_archive('mec-events') || is_tax('mec_category') || is_tax('mec_tag') || $get_post_type == 'mec-events') {
    $featured_img_url = get_stylesheet_directory_uri().'/theme-core/theme-1/img/bg-events.png';
  }

  // featured image
     ?>
    <div class="bg-c">
      <div class="v-container">
        <div class="title-cat_page">

        <div class="box-cc">
          <?php if (is_single()) {
            $hTags = 'h2';
          }
          else {
            $hTags = 'h1';
          }
          ?>
          <<?php echo $hTags; ?> class="head-c">
            <?php
            if (is_page()) {
              the_title();
             }
            if (is_singular('post')) {
              echo $title_name;
            }
            if (is_post_type_archive('e-book') || $get_post_type == 'e-book') {
              yp_text('คลังหนังสือออนไลน์','E-Book');
            }
            if (is_post_type_archive('mec-events') || $get_post_type == 'mec-events') {
              yp_text('ปฏิทินกิจกรรม','Calendar');
            }

            if (is_archive()) {
              single_cat_title();
            }
            if ($_GET['_sf_s']) {
              yp_text('ผลการค้นหา','Search Results');
            }
            if (is_home() && $_GET['_sf_s'] == '') {
              yp_text('บทความทั้งหมด','All Post');
            }
          ?>
        </<?php echo $hTags; ?>>
          <p class="ex-cat">
            <?php
            if ($excerpt_category) {
              echo $excerpt_category;
            }
             ?>
          </p>
        </div>

            <div class="breadcrumb-text">
                <?php
                  if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                  }
                ?>
            </div>
        </div>

        <div class="title-cat_right"></div>

      </div>
    </div>
</div>
</header><!-- .entry-header -->

<style>

.title-cat_right:after {
    content: '';
    width: 200%;
    height: 100%;
    right: -100%;
    position: absolute;
    background: url('<?php  if ($featured_img_url): echo $featured_img_url; else: echo '/wp-content/themes/fluffy/img/default-cat.jpg';  endif; ?>');
    display: block;
    top: 0;
    background-size: cover;
    background-position: center;
}


@media (max-width: 1600px) {
}
/*laptop*/
@media (max-width: 1280px) {

}
/*ipad pro (large tablet)*/
@media (max-width: 1024px) and (min-width: 992px) {


}
@media (max-width: 991.98px) {

  .title-cat_page {
      padding: 30px 20px 30px;
  }
  .bg-c .v-container {
    grid-template-columns: 1fr;
    min-height: 225px;
    padding: 0;
  }
    .title-cat_right {
        height: 200px;
    }
    .theme-five .box-cc {
        border-left-width: 2px;
        padding-left: 8px;
    }

}
/*iphone8 (smartphone)*/
@media (max-width: 575.98px) {
}
/*iphone5 (small smartphone)*/
@media (max-width: 360px) {
}
</style>
