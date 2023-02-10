<header class="entry-header">
  <div class="wrap-thumb-header ">

  <?php
  // featured image
  if ($post_type == 'vc_video') {
  	$taxonomy = 'vc_video_category';
  	$tags = 'vc_video_tags';
  }
  elseif ($post_type == 'vc_photo') {
  	$taxonomy = 'vc_photo_category';
  	$tags = 'vc_photo_tags';
  }
  elseif ($post_type == 'e-book') {
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
if (is_post_type_archive('post')) {
    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy;
    $term_id = $queried_object->term_id;
    $excerpt_category = get_field('excerpt_category', 'category_' . $term_id  );
    $featured_img_url = get_field('banner_image_cat','category_'.$term_id);

    $featured_img_url = $featured_img_url['url'];
  }
 if (is_post_type_archive('e-book')) {
    $featured_img_url = '/wp-content/themes/fluffy/img/default-cat.jpg';
  }
if (is_post_type_archive('mec-events') || is_tax('mec_category') || is_tax('mec_tag') || $get_post_type == 'mec-events') {
    $featured_img_url = get_stylesheet_directory_uri().'/theme-core/theme-1/img/bg-events.png';
  }
if (is_post_type_archive('vc_video') || is_tax('vc_video_category') || is_tax('vc_video_tags') || $get_post_type == 'vc_video') {
    $featured_img_url = get_stylesheet_directory_uri().'/img/video-cat.jpg';
  }
if (is_post_type_archive('vc_photo') || is_tax('vc_photo_category') || is_tax('vc_photo_tags') || $get_post_type == 'vc_photo') {
    $featured_img_url = get_stylesheet_directory_uri().'/img/photo-cat.jpg';
  }

  // featured image

  if ($featured_img_url): ?>
    <div class="in-thumb" style="background-image:url('<?php echo $featured_img_url; ?>')">
      <div class="v-container">
        <h3 class="byline">
          <?php
          if (is_page()) {
            the_title();
           }
          if (is_singular()) {
            echo $title_name;
          }
          if (is_post_type_archive('e-book')) {
            yp_text('คลังหนังสือออนไลน์','E-Book');
          }
          if (is_post_type_archive('mec-events') || is_singular('mec-events')) {
            yp_text('ปฏิทินกิจกรรม','Calendar');
          }
          if (is_post_type_archive('vc_photo') || is_singular('vc_photo')) {
            yp_text('คลังภาพ','Gallery');
          }
          if (is_post_type_archive('vc_video') || is_singular('vc_video')) {
              yp_text('วีดีโอ','Videos');
          }
          if (is_archive()) {
            single_cat_title();
          }
          if (is_singular('wpdmpro')) {
            the_title();
            }
          if (is_singular('poll')) {
            yp_text('แบบสอบถาม','Poll/Vote');
          }
             ?>
        </h3>
      </div>
    </div>
    <?php else: ?>
    <div class="in-thumb" style="background-image:url('/wp-content/themes/fluffy/img/default-cat.jpg');">
        <div class="v-container">
             <h3 class="byline">
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
               if (is_post_type_archive('vc_photo') || $get_post_type == 'vc_photo') {
                 yp_text('คลังภาพ','Gallery');
               }
               if (is_post_type_archive('vc_video') || $get_post_type == 'vc_video') {
                   yp_text('วีดีโอ','Videos');
               }
               if (is_archive()) {
                 single_cat_title();
               }
               if (is_singular('wpdmpro')) {
                 the_title();
                 }
               if (is_singular('poll')) {
                 yp_text('แบบสอบถาม','Poll/Vote');
               }
                  ?>
             </h3>
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
