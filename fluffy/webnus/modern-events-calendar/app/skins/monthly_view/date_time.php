<?php
ob_start();
$start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
$end_time = (isset($event->data->time) ? $event->data->time['end'] : '');


$startDate = !empty($event->data->meta['mec_date']['start']['date']) ? $event->data->meta['mec_date']['start']['date'] : '';
$endDate = !empty($event->data->meta['mec_date']['end']['date']) ? $event->data->meta['mec_date']['end']['date'] : '' ;
$event_start_date = !empty($event->date['start']['date']) ? $event->date['start']['date'] : '';

$str_old = $startDate;
$str_format = strtotime( $str_old );
$end_old = $endDate;
$end_format = strtotime( $end_old );
?>
<a href="<?php the_permalink($event->ID); ?>" class="link-all"></a>
<div class="left">
  <div class="day-box">
    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
    <div class="ob2">
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
   <div class="view">
     <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
	<?php echo do_shortcode('[vc_post_view id="'.$event->ID.'"]'); ?>
   </div>
</div>
<?php
$output_string = ob_get_contents();
ob_end_clean();
$events_str .=  $output_string;
