<?php if ($id) {
  // $formApi = fluentFormApi('forms')->entryInstance($formId = $id);
  // $report = $formApi->report( $status = array('read','unread') );
  //
  // if ( is_array($report['report_items']) ) {
  //
  // $report = $report['report_items']['input_radio']['reports'];
  // usort($report, function($a, $b) {
  //     return $b['count'] - $a['count'];
  //   });
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => get_site_url().'/wp-json/vote/update/api/?vote_id='.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$response = json_decode($response);
?>
    <div class="content_vote">
      <div class="wrap-realtime-vote-out">
          <?php
          foreach ($response as $value):
            ?>
              <div class="realtime-item" data-item="<?php echo $value->choice_label; ?>">
                <div class="toolstrip">
                  <?php echo $value->choice_label; ?>
                </div>
                <div class="wrap-count">
                  <div class="number">
                  <?php echo $value->number; ?>
                  </div>
                  <div class="count">
                    <div class="num">
                      <?php echo $value->count; ?>
                    </div>
                    <div class="txt">
                      คะแนน
                    </div>
                  </div>
                </div>

              </div>
          <?php endforeach; ?>
      </div>
    </div>
    <?php
  }
?>
