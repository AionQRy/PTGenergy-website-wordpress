<?php
// function set_test(){
//   $now = date_i18n("Y-m-d H:i");
//   $date_sent = get_field('date_sent','option');
//   $date_sent = date_i18n("Y-m-d H:i", strtotime($date_sent));
//   $tz = new DateTimeZone('Asia/Bangkok');
//   $date_sent_tz = new DateTime($date_sent.'GMT+14');
//   $date_sent_tz->setTimezone($tz);
//   $date_sent_tz = $date_sent_tz->format('Y-m-d H:i')."\n";
//   echo $date_sent.'<BR>'.$now;
//
//   if ($date_sent >= $now) {
//     echo "a";
//   }
//   else {
//     echo "b";
//   }
// }
// add_action('init','set_test');

$date_sent = get_field('date_sent','option');
if (!empty($date_sent) ) {

  $datetime = new DateTime( 'now', new DateTimeZone( 'Asia/Bangkok' ) );
  $now = $datetime->format('Y-m-d H:i:s');
  $date_sent = date_i18n("Y-m-d H:i:s", strtotime($date_sent));

  // if ($now <= $date_sent) {


    function yp_auto_send_mail_cron_schedule( $schedules ) {
          $schedules['every_one_hours'] = array(
            // 'interval' => 86400 , // Every 24 hours
            'interval' => 3600,
            'display'  => __( 'Every 1 hours' ),
          );
          return $schedules;
      }

      add_filter( 'cron_schedules', 'yp_auto_send_mail_cron_schedule' );


      if ( ! wp_next_scheduled( 'yp_auto_send_mail_hook' ) ) {
        $now = date_i18n("Y-m-d H:i");
        $date_sent = get_field('date_sent','option');
        $date_sent = date_i18n("Y-m-d H:i", strtotime($date_sent));
        $tz = new DateTimeZone('Asia/Bangkok');
        $date_sent_tz = new DateTime($date_sent.'GMT+14');
        $date_sent_tz->setTimezone($tz);
        $date_sent_tz = $date_sent_tz->format('Y-m-d H:i')."\n";

        if ($date_sent >= $now) {
          wp_schedule_single_event( strtotime($date_sent_tz), 'yp_auto_send_mail_hook' );
        }
        else {
          wp_clear_scheduled_hook( 'yp_auto_send_mail_hook' );
        }

      }

      add_action( 'yp_auto_send_mail_hook', 'yp_auto_send_mail_func' );

      function yp_auto_send_mail_func()  {


        $date_sent = get_field('date_sent','option');
        $now = date_i18n("Y-m-d H:i:s");
        $date_sent = date_i18n("Y-m-d H:i:s", strtotime($date_sent));
        $date_sent_log = get_field('date_sent_log','option');

        if ($now >= $date_sent) {
          if (empty($date_sent_log)) {
            yp_send_news();
            update_field('date_sent_log', 'ส่งเมลแล้ว '.date_i18n("d-m-Y H:i:s"), 'option');
            wp_clear_scheduled_hook( 'yp_auto_send_mail_hook' );
          }
        }
        else {
          update_field('date_sent_log', '', 'option');
        }

      }


  // }


}
else {
  wp_clear_scheduled_hook( 'yp_auto_send_mail_hook' );
}
 ?>
