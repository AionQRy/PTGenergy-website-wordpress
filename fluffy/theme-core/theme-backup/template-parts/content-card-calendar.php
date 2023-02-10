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
<article id="post-<?php the_ID(); ?>" class="post-card-two">
    <div class="main-object">
        <div class="object-1">
            <div class="box-cat">
                <span class="cat-text">
                    <span class="day">
                        <?php echo date_i18n( "d", $str_format ); ?>
                    </span>
                    <span class="m-y">
                        <?php echo date_i18n( "F", $str_format ); ?>
                    </span>
                    <span class="m-y-m">
                        <?php echo date_i18n( "Y", $str_format ); ?>
                    </span>
                </span>
            </div>
        </div>
        <div class="object-2">
			<div class="box-title">
                <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></h3></a>
            </div>
            <?php
                       $term_list = get_the_terms(get_the_ID(), 'mec_category');
                       $types ='';
                       foreach($term_list as $term_single) {
                            $types .= ucfirst($term_single->name).'';
                       }
                       $typesz = rtrim($types, '');
                       ?>

            <div class="box-info_column">
                <div class="main-object">
                <div class="object-1">
                        <?php if($str_format): ?>
						<span class="calendar-text">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="#0074bc" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <div class="flex-x">
                            <div class="day-box">
                                <?php
                                if(date_i18n( "m Y", $str_format ) == date_i18n( "m Y", $end_format ) ){
                                    echo date_i18n( "d", $str_format ) . '-' . date_i18n( "d", $end_format ). ' '. date_i18n( "F", $str_format ).
                                     ' '. date_i18n( "Y", $str_format );
                                }else{
                                    echo get_post_meta( get_the_ID(), 'mec-events-abbr', true );
                                    echo date_i18n( "d F Y", $str_format ) .  '-'. date_i18n( "d F Y", $end_format );
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
                    <div class="object-2">
                    <?php
                       $mec_location = get_the_terms(get_the_ID(), 'mec_location');
                       $types ='';
                       foreach($mec_location as $term_single) {
                            $types .= ucfirst($term_single->name).'';
                       }
                       $typesx = rtrim($types, '');
                       ?>
                    <?php if ( $mec_location ) :  ?>
                        <span class="calendar-text">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="#0074bc" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> 
                        <?php
                            echo $typesx; // Show Location
                        ?>
                        </span>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
