<?php
get_template_part( 'template-parts/post-meta-s2');
$style_2 = 'style-2';
  ?>
<div class="wrap-single <?php echo $style_2; ?>">

<?php if (has_post_thumbnail()): ?>
  <div class="entry-featured-image hide">
  <?php the_post_thumbnail(); ?>
  </div>
<?php endif; ?>


<div class="yp_single_content">

  <?php
   if (get_post_type() == 'mec-events'): ?>
    <div class="event-meta">
      <?php

      $str_old = get_post_meta( get_the_ID(), 'mec_start_date', true );
      $str_format = strtotime( $str_old );
      $end_old = get_post_meta( get_the_ID(), 'mec_end_date', true );
      $end_format = strtotime( $end_old );
                  // Display date in the format "l d F, Y".
      $str_time_hour = get_post_meta( get_the_ID(), 'mec_start_time_hour', true );
      $str_time_min = get_post_meta( get_the_ID(), 'mec_start_time_minutes', true );
      $str_time_am_pm = get_post_meta( get_the_ID(), 'mec_start_time_ampm', true );

      $end_time_hour = get_post_meta( get_the_ID(), 'mec_end_time_hour', true );
      $end_time_min = get_post_meta( get_the_ID(), 'mec_end_time_minutes', true );
      $end_time_am_pm = get_post_meta( get_the_ID(), 'mec_date_start', true );

      $single = new MEC_skin_single();
      $single_event_main = $single->get_event_mec(get_the_ID());
      $single_event_obj = $single_event_main[0];
       ?>
       <div class="calendar-date">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 20h-4v-4h4v4zm-6-10h-4v4h4v-4zm6 0h-4v4h4v-4zm-12 6h-4v4h4v-4zm6 0h-4v4h4v-4zm-6-6h-4v4h4v-4zm16-8v22h-24v-22h3v1c0 1.103.897 2 2 2s2-.897 2-2v-1h10v1c0 1.103.897 2 2 2s2-.897 2-2v-1h3zm-2 6h-20v14h20v-14zm-2-7c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-14 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2z"/></svg>
         <?php if($str_format): ?>
             <span class="calendar-text">
                <div class="flex-x">
                <div class="day-box">
                    <?php

                    if (date_i18n( "d", $str_format ) == date_i18n( "d", $end_format )) {
                      echo date_i18n( "d", $str_format ).' '. date_i18n( "F", $str_format ).
                       ' '. date_i18n( "Y", $str_format );
                    }
                    else {
                      if(date_i18n( "m Y", $str_format ) == date_i18n( "m Y", $end_format ) ){
                          echo date_i18n( "d", $str_format ) . '-' . date_i18n( "d", $end_format ). ' '. date_i18n( "F", $str_format ).
                           ' '. date_i18n( "Y", $str_format );
                      }else{
                          echo get_post_meta( get_the_ID(), 'mec-events-abbr', true );
                          echo date_i18n( "d F Y", $str_format ) .  '-'. date_i18n( "d F Y", $end_format );
                      }
                    }


                    ?>
                 </div>
                </div>
                </span>
            <?php
                if (isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start'])) {
                    if (isset($event->data->meta['mec_hide_time']) and $event->data->meta['mec_hide_time'] == '0') {
                        $time_comment = isset($event->data->meta['mec_comment']) ? $event->data->meta['mec_comment'] : '';
                        $allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
                        ?>
                            <div class="mec-single-event-time">
                                <i class="mec-sl-clock " style=""></i>
                                <h3 class="mec-time"><?php _e('Time', 'modern-events-calendar-lite'); ?></h3>
                                <i class="mec-time-comment"><?php echo (isset($time_comment) ? $time_comment : ''); ?></i>
                                <dl>
                                <?php if ($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])) : ?>
                                    <dd><abbr class="mec-events-abbr"><?php echo $event->data->time['start']; ?><?php echo (trim($event->data->time['end']) ? ' - ' . $event->data->time['end'] : ''); ?></abbr></dd>
                                <?php else : ?>
                                    <dd><abbr class="mec-events-abbr"><?php echo $this->main->m('all_day', __('All Day' , 'modern-events-calendar-lite')); ?></abbr></dd>
                                <?php endif; ?>
                                </dl>
                            </div>
                        <?php
                    }
                }
            ?>
            <?php endif; ?>

       </div>

       <div class="calendar-time">
        <?php
        $single->display_time_widget($single_event_obj);
        ?>
       </div>

       <div class="locate_text">
         <?php
           $mec_location = get_the_terms(get_the_ID(), 'mec_location');
           $types ='';
           foreach($mec_location as $term_single) {
               $types .= ucfirst($term_single->name).'';
           }
           $locate_title = rtrim($types, '');
           ?>
       <?php if ( $mec_location ) :  ?>
         <span class="calendar-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="63" height="62" viewBox="0 0 63 62" fill="none">
<path d="M55.125 25.8334C55.125 43.9167 31.5 59.4167 31.5 59.4167C31.5 59.4167 7.875 43.9167 7.875 25.8334C7.875 19.6671 10.3641 13.7534 14.7946 9.39314C19.2251 5.03292 25.2343 2.58337 31.5 2.58337C37.7657 2.58337 43.7748 5.03292 48.2054 9.39314C52.6359 13.7534 55.125 19.6671 55.125 25.8334Z" fill="#ED1C24"></path>
<path d="M31.5 33.5834C35.8492 33.5834 39.375 30.1136 39.375 25.8334C39.375 21.5532 35.8492 18.0834 31.5 18.0834C27.1508 18.0834 23.625 21.5532 23.625 25.8334C23.625 30.1136 27.1508 33.5834 31.5 33.5834Z" fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
         <?php echo $locate_title; ?>
         </span>
       <?php endif; ?>
       </div>
     </div>

<?php endif; ?>


  <?php
  $single_image_content = get_field('single_image_content');
  if (!empty($single_image_content)) {
    ?>
    <img style="margin-bottom:10px;" src="<?php echo $single_image_content['url']; ?>" alt="<?php the_title(); ?>">
    <?php
  }
  the_content();


  if (get_field('ebook_file')) {
  echo do_shortcode('[dflip source="'.get_field('ebook_file')['url'].'"]');
    echo "<BR>";
  }
  ?>

  <?php if (get_field('forms_shortcode')): ?>
    <div class="events-form-wrap">
      <div class="events-form">
        <h4>ลงทะเบียนกิจกรรม</h4>
          <?php echo do_shortcode(get_field('forms_shortcode')); ?>
      </div>
    </div>
  <?php endif; ?>

  <?php

  $mec_location = get_the_terms(get_the_ID(), 'mec_location');
  $types ='';
  foreach($mec_location as $term_single) {
      $types .= ucfirst($term_single->name).'';

      $latitude = get_metadata('term', $term_single->term_id, 'latitude', true);
      $longitude = get_metadata('term', $term_single->term_id, 'longitude', true);
  }
  $locate_title = rtrim($types, '');

   ?>
   <?php if ($latitude): ?>
     <div class="v-wrap-map section-box-single">
       <h3 class="section-title"><?php echo $locate_title; ?></h3>
       <div class="v-map">
         <iframe
         width="100%"
         height="400px"
         frameborder="0"
         scrolling="no"
         marginheight="0"
         marginwidth="0"
         src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&hl=th&z=16&amp;output=embed"
        >
        </iframe>
       </div>
     </div>
   <?php endif; ?>

</div>

<?php if (get_field('video_post_embed')): ?>
<div class="video_embed_wrap">
<?php echo get_field('video_post_embed'); ?>
</div>
<?php endif; ?>

<?php
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'large');
$video_1 = get_field('video_480p');
$video_2 = get_field('video_720p');
$video_3 = get_field('video_1080p');
?>

<?php if ($video_1 != '' || $video_2 != '' || $video_3 != ''): ?>

<link  rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/include/css/plyr.css"/>
<script src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/include/js/plyr.js"></script>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
// This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
const player = new Plyr('#player');
// Expose
window.player = player;
// Bind event listener
function on(selector, type, callback) {
  document.querySelector(selector).addEventListener(type, callback, false);
}
});
</script>

<div class="video_local_wrap">
<video controls crossorigin playsinline poster="<?php echo $featured_img_url; ?>" id="player" style="--plyr-color-main: #00ab4e;">
<?php if ($video_1['url']): ?>
<source src="<?php echo $video_1['url']; ?>" type="video/mp4" size="480">
<?php endif; ?>

<?php if ($video_2['url']): ?>
<source src="<?php echo $video_2['url']; ?>" type="video/mp4" size="720">
<?php endif; ?>

<?php if ($video_3['url']): ?>
<source src="<?php echo $video_3['url']; ?>" type="video/mp4" size="1080">
<?php endif; ?>

</video>
<a download target="_blank" href="<?php echo $video_2['url']; ?>" class="btn-video-download">
<?php yp_text('ดาวน์โหลด','Download'); ?> <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><polyline points="8 12 12 16 16 12"></polyline><line x1="12" y1="8" x2="12" y2="16"></line></svg>
</a>
</div>

<?php endif; ?>


<div class="left-share hide">
<h4><?php // yp_text('แชร์เลย','Share this') ?></h4>
<?php // echo do_shortcode('[Sassy_Social_Share]'); ?>
</div>
<div class="left-tags <?php echo $style_2; ?>">
<span>Tags: </span>
<?php
$tags_lists = wp_get_post_terms( get_the_ID(), $tags );
if (!empty($tags_lists)) { ?>
<?php if ($style_2): ?>
 <div class="tags_list">
 <?php else: ?>
   <div class="tags_list">
<?php endif; ?>
<?php
foreach($tags_lists as $tags_list) {
?>
  <a href="<?php echo get_category_link( $tags_list->term_id ) ?>">
       <?php echo $tags_list->name; ?>
  </a>
<?php  }  ?>
</div>
<?php	} else{ ?>
<style media="screen">
.left-tags{
display: none!important;
}
</style>
<?php }	?>
</div>




<?php

$gallery = get_field('gallery_post');
 if( $gallery ): ?>
 <style media="screen">
 .wrap_yp_gallery {
     display: flex;
     flex-wrap: wrap;
     margin: 0 -5px;
 }
 .wrap_yp_gallery a.yp_gallery_item {
     width: calc(25% - 10px);
     float: left;
     display: none;
     margin: 5px;
 }
 .wrap_yp_gallery a.yp_gallery_item:nth-child(1) {
   display: block;
}
 .wrap_yp_gallery a.yp_gallery_item:nth-child(2) {
    display: block;
 }
 .wrap_yp_gallery a.yp_gallery_item:nth-child(3) {
   display: block;
}
.wrap_yp_gallery a.yp_gallery_item:nth-child(4) {
   display: block;
}
.wrap_yp_gallery a.yp_gallery_item:nth-child(5) {
   display: block;
}

.wrap_yp_gallery a.yp_gallery_item .item-thumbs{
  padding-bottom: calc( 0.68 * 100% );
  position: relative;
  transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
  overflow: hidden;
}

.wrap_yp_gallery a.yp_gallery_item .item-thumbs img{
display: block;
-webkit-transition: -webkit-filter .3s;
transition: -webkit-filter .3s;
-o-transition: filter .3s;
transition: filter .3s;
transition: filter .3s,-webkit-filter .3s;
height: 100%;
width: 100%;
position: absolute;
top: calc(50% + 1px);
left: calc(50% + 1px);
-webkit-transform: scale(1.01) translate(-50%,-50%);
-ms-transform: scale(1.01) translate(-50%,-50%);
transform: scale(1.01) translate(-50%,-50%);
object-fit: cover;
}

.wrap_yp_gallery .overlay_thumb {
    position: absolute;
    top: 0;
    left: 0;
    background: #0000008f;
    color: #FFF;
    content: '';
    display: block;
    z-index: 123;
    width: 100%;
    height: 100%;
}
.wrap_yp_gallery .in-overlay{
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  position: absolute;
}
.wrap_yp_gallery .in-overlay span {
    font-size: 28px;
}
.wrap_yp_gallery .in-overlay svg {
    margin-bottom: -0.25em;
    margin-right: 1px;
}
.fancybox__thumbs .carousel__slide .fancybox__thumb::after{
  border-color: #f9aa2b!important;
}
 .wrap_yp_gallery a.yp_gallery_item:hover{
   opacity: 0.9;
 }
 .fancybox__container{
   z-index: 9999!important;
 }

 /*for tabletV*/
 @media (min-width: 768px) and (max-width: 991px) {
   .wrap_yp_gallery a.yp_gallery_item {
      margin-bottom: 10px;
   }
 }
 @media (max-width:767px) {
   .wrap_yp_gallery a.yp_gallery_item {
     width: calc(50% - 10px);
     margin-bottom: 10px;
     }
 }
 </style>

<link  rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/include/css/fancybox.css"/>
<script src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/include/js/fancybox.min.js"></script>


<div class="gallery-single section-box-single">
  <h3 class="section-title">
    <div class="icon-title">
      <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="images" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-images fa-w-18 fa-3x"><path fill="currentColor" d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v48H54a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6v-10h48zm42-336H150a6 6 0 0 0-6 6v244a6 6 0 0 0 6 6h372a6 6 0 0 0 6-6V86a6 6 0 0 0-6-6zm6-48c26.51 0 48 21.49 48 48v256c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h384zM264 144c0 22.091-17.909 40-40 40s-40-17.909-40-40 17.909-40 40-40 40 17.909 40 40zm-72 96l39.515-39.515c4.686-4.686 12.284-4.686 16.971 0L288 240l103.515-103.515c4.686-4.686 12.284-4.686 16.971 0L480 208v80H192v-48z" class=""></path></svg>
    </div>
    <?php if (get_locale() == 'th') { 	echo "รูปภาพที่เกี่ยวข้อง"; } else { echo "Gallery"; } ?>
  </h3>
  <div class="wrap_yp_gallery">
      <?php
      $i = 0;
      $count_gallery = count($gallery)-5;
      foreach( $gallery as $galleries ):
      $i++;
      ?>
              <a data-fancybox="gallery" class="yp_gallery_item"  href="<?php echo esc_url($galleries['url']); ?>">
                <div class="item-thumbs">
                  <div class="overlay_thumb_single">
                      <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                  </div>

                  <?php if ($i == 5): ?>
                    <div class="overlay_thumb">
                      <div class="in-overlay">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        <span>+<?php echo $count_gallery; ?></span>
                      </div>
                    </div>
                  <?php endif; ?>

                  <img src="<?php echo esc_url($galleries['sizes']['large']); ?>" alt="<?php echo esc_url($galleries['name']); ?>">
                </div>
              </a>
      <?php endforeach; ?>
  </div>
</div>
 <?php endif; ?>

<?php
$pdf_post = get_field('pdf_post');
if( $pdf_post ):
$url_pdf = $pdf_post['url'];
?>
<style media="screen">
  .box-show_pdf{
    margin-top: 15px;
  }
</style>
<div class="box-show_pdf">
    <?php echo do_shortcode( "[pdf-embedder toolbarfixed='on' toolbar='top' url='$url_pdf']" );?>
</div>
<?php endif; ?>




<div class="clearfix"></div>

<?php if (get_field('files_download') && get_field('files_download')[0]['file_download'] != '' ): ?>

  <div class="file_url_list section-box-single">
    <h3 class="section-title">
      <div class="icon-title">
        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
      </div>
      <?php
      yp_text('ไฟล์เอกสารที่เกี่ยวข้อง','File Attachment');
       ?>
    </h3>

      <?php if( have_rows('files_download') ): ?>
        <?php while( have_rows('files_download') ): the_row();?>
            <?php
             $url_host = get_sub_field('file_download');
             $ext = pathinfo($url_host['url'], PATHINFO_EXTENSION);

             if ($ext == 'pdf') {
                 $file_icon_type = get_stylesheet_directory_uri().'/img/pdf.svg';
             }

            else if ($ext == 'xlsx') {
                 $file_icon_type = get_stylesheet_directory_uri().'/img/xls.svg';
             }

             else if ($ext == 'xls') {
                 $file_icon_type = get_stylesheet_directory_uri().'/img/xls.svg';
             }

             else if ($ext == 'doc') {
                 $file_icon_type = get_stylesheet_directory_uri().'/img/doc.svg';
             }

            else if ($ext == 'docx') {
                 $file_icon_type = get_stylesheet_directory_uri().'/img/doc.svg';
             }

            else if ($ext == 'ppt') {
                 $file_icon_type = get_stylesheet_directory_uri().'/img/pptx.svg';
             }

            else if ($ext == 'pptx') {
                 $file_icon_type = get_stylesheet_directory_uri().'/img/pptx.svg';
             }
             else {
                  $file_icon_type = get_stylesheet_directory_uri().'/img/log.svg';
              }
              // print_r($url_host);
            ?>
          <div class="wrap-all-list new">
            <img style="margin-left: 5px" src="<?php echo $file_icon_type; ?>" alt="icon_type">
              <div class="file_url_item">
                <a target="_blank" href="<?php echo $url_host['url']; ?>"><?php echo get_sub_field('file_name'); ?></a>
                <div class="file_url_sub">
                  <ul>
                    <li>
                      <?php yp_text('ขนาดไฟล์','File Size'); ?> : <span><?php echo number_format( $url_host['filesize']/1048576 ,2); ?> MB</span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="file-btn">
                <a target="_blank" href="<?php echo $url_host['url']; ?>" class="btn-file-download">
                  <?php if (get_locale() == 'th'): ?>
                      <?php echo "ดาวน์โหลด"; ?>
                    <?php else: ?>
                      <?php echo "Download"; ?>
                  <?php endif; ?>
                  <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><polyline points="8 12 12 16 16 12"></polyline><line x1="12" y1="8" x2="12" y2="16"></line></svg>
                </a>
              </div>
              <div class="clearfix"></div>
          </div>

          <?php endwhile; ?>
      <?php endif; ?>
 </div>
<?php endif; ?>

</div>
