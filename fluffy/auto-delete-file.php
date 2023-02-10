<?php
$enable_setting = get_field('enable_setting','option');
if ($enable_setting) {

  global $num_days;
  $num_days = get_field('num_days','option');


  function yp_auto_delete_cron_schedule( $schedules ) {
    global $num_days;
      $schedules['every_one_hours'] = array(
        // 'interval' => 86400 , // Every 24 hours
        'interval' => 66400,
        'display'  => __( 'Every 1 Days' ),
      );
      return $schedules;
  }
  add_filter( 'cron_schedules', 'yp_auto_delete_cron_schedule' );

  if ( ! wp_next_scheduled( 'yp_auto_delete_file_hook' ) ) {
      wp_schedule_event( time(), 'every_one_hours', 'yp_auto_delete_file_hook' );
  }

   add_action( 'yp_auto_delete_file_hook', 'yp_auto_delete_file_func' );
   // add_action( 'admin_init', 'yp_auto_delete_file_func' );

  function yp_auto_delete_file_func ()  {
      global $num_days;
      // echo "string";
      // echo $num_days;

      // $args = array (
      //     'post_type' => 'attachment',
      //     'post_status' => 'inherit',
      //     'date_query' => array (
      //         'before' => "$num_days days ago",
      //         ),
      //     'posts_per_page' => -1,
      //     ) ;
      // $old_attachments = new WP_Query ($args) ;
      //
      //   while ($old_attachments->have_posts()) {
      //     $old_attachments->the_post () ;
      //
      //     wp_delete_attachment (get_the_ID(), true);
      //   }

      $args = array (
          'post_type' => 'post',
          // 'post_status' => 'inherit',
          'date_query' => array (
              'before' => "$num_days days ago",
              ),
          'posts_per_page' => -1,
          ) ;
      $old_attachments = new WP_Query ($args) ;

        while ($old_attachments->have_posts()) {
          $old_attachments->the_post () ;

          if ( get_field( 'disable_delete',get_the_ID() )[0] == 1) {
            continue;
          }
          else {
              wp_delete_post ( get_the_ID() );
          }
          // echo get_the_ID();

        }


      wp_reset_postdata();
  }


}
else {
  wp_clear_scheduled_hook( 'yp_auto_delete_file_hook' );
}


 ?>
