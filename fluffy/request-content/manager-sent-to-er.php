<?php
$er_users_list_s = get_field('er_users_list','option');
foreach ($er_users_list_s as $value) {
    $er_mail = $value['group_email']['user_email']; ?>
    <?php ob_start(); ?>
    <?php
    $post_id = $current_post_id;
    $reSubject = get_field('reSubject',$post_id);
    $user_submit = get_user_by('ID', get_field('reuser_id',$post_id));
    update_field('reStatus','status_04',$current_post_id);



    date_default_timezone_set("Asia/Bangkok");

    $todatDate = date('Y-m-d H:i:s');
    $todatDate = date('Y-m-d H:i:s', strtotime($todatDate));
    $post_start = get_field('reDate_start',$post_id);
    $post_start = str_replace('/', '-', $post_start );
    $post_start = date("Y-m-d", strtotime($post_start));



    // $todatChk = date('Y-m-d');
    // $todatChk = date('Y-m-d', strtotime($todatChk));
      // $date1 = new DateTime($todatChk);
      //  $date2 = new DateTime("2022-10-31");
      //  $interval = $date1->diff($date2);
      //  echo $interval->d;

    $day = date('w');
    $friday = date('Y-m-d 11:59:59', strtotime('+'.(5-$day).' days'));
    $friday_next = date('Y-m-d', strtotime('+'.(12-$day).' days'));

    $monday_next_week = date('d/m/Y', strtotime('+'.(15-$day).' days'));
    $tuesday_next_week = date('d/m/Y', strtotime('+'.(16-$day).' days'));
    // $wednesday_next_week = date('d/m/Y', strtotime('+'.(17-$day).' days'));
    $thursday_next_week = date('d/m/Y', strtotime('+'.(18-$day).' days'));
    // $friday_next_week = date('d/m/Y', strtotime('+'.(19-$day).' days'));
    $category = get_field('reCat',$post_id);


    $now = new DateTime();
    $created_at = $now->format('Y-m-d H:i:s');
    $username = get_userdata(get_current_user_id());
    $post_start_old = get_field('reDate_start',$post_id);

    if ($todatDate > $friday && $post_start <= $friday_next) {
      if ($category['value'] == 'cat_01' || $category['value'] == 'cat_02' ) {

        $row = array(
         's1_uid' => $username->user_login,
         's1_comment' => 'เปลี่ยนแปลงวันที่ต้องการประชาสัมพันธ์ จาก '.$post_start_old.' เป็น '.$monday_next_week,
         'create_at' => $created_at
        );
        $add_comment = add_row( 'comment_s1', $row ,$current_post_id);

        update_field('reDate_start',$monday_next_week,$post_id);
      }
      if ($category['value'] == 'cat_03' || $category['value'] == 'cat_04' ) {

        $row = array(
         's1_uid' => $username->user_login,
         's1_comment' => 'เปลี่ยนแปลงวันที่ต้องการประชาสัมพันธ์ จาก '.$post_start_old.' เป็น '.$monday_next_week,
         'create_at' => $created_at
        );
        $add_comment = add_row( 'comment_s1', $row ,$current_post_id);

        update_field('reDate_start',$tuesday_next_week,$post_id);
      }
      if ($category['value'] == 'cat_05' || $category['value'] == 'cat_06' ) {

        $row = array(
         's1_uid' => $username->user_login,
         's1_comment' => 'เปลี่ยนแปลงวันที่ต้องการประชาสัมพันธ์ จาก '.$post_start_old.' เป็น '.$monday_next_week,
         'create_at' => $created_at
        );
        $add_comment = add_row( 'comment_s1', $row ,$current_post_id);

        update_field('reDate_start',$thursday_next_week,$post_id);
      }
    }
    ?>
    <h3>เรียน ทีม ER</h3>
    <table width="500px" style="border: solid 1px #000;border-collapse: collapse;">
      <thead>
        <tr>
          <td style="background:#8acd56;border: solid 1px #000;padding: 3px 5px;" colspan="2">คำร้องประกาศ : <?php echo $post_id; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">ผู้ยื่นคำรอง</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo $user_submit->first_name.' '.$user_submit->last_name; ?></td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">วันที่ส่งคำร้อง</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_the_date('d/m/Y',$post_id); ?></td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">เรื่อง</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_field('reSubject',$post_id); ?></td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">สถานะ</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;">
            <?php
              $field = get_field_object( 'reStatus', $post_id);
              $status = $field['value'][ 'label' ];
              echo $status;
             ?>
         </td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">หมวดหมู่</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;">
            <?php
              $field = get_field_object( 'reCat', $post_id);
              $label = $field['value'][ 'label' ];
              echo $label;
             ?>
         </td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">วัตถุประสงค์</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_field('reObj',$post_id); ?></td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">รายละเอียด</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_field('reDetail',$post_id); ?></td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">วันที่ต้องการประชาสัมพันธ์</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo yp_thai_year(get_field('reDate_start',$post_id)).' - '.yp_thai_year(get_field('reDate_end',$post_id)); ?></td>
        </tr>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">ช่องทางการสื่อสาร</td>
          <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php $reChannel2 = get_field_object('reChannel',$post_id)['value'];  echo implode(', ', array_column($reChannel2, 'label')); ?></td>
        </tr>

        <?php if (get_field('file_work',$post_id)): ?>
          <tr>
            <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">ไฟล์แนบ</td>
            <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;">
              <a target="_blank" class="view-work" href="<?php
              if ( str_contains( get_field('file_work',$post_id), get_site_url() ) ) {
                  echo get_field('file_work',$post_id);
              }
              else {
                  echo get_site_url().get_field('file_work',$post_id);
              }
              ?>">ดูไฟล์งาน</a>
            </td>
          </tr>
        <?php endif; ?>
        <tr>
          <td style="background:#8bce94;border: solid 1px #000;padding: 3px 5px;" width="50%">ลิงก์คำร้องประกาศ</td>
          <td width="50%" style="border: solid 1px #000;padding: 3px 5px;"><a href="<?php echo get_the_permalink($post_id); ?>">จัดการคำร้องประกาศ</a></td>
        </tr>
      </tbody>
    </table>
    <br>
    <p style="margin: 0;">หากคุณไม่สามารถเข้าลิงก์ จัดการคำร้องประกาศ คุณสามารถคัดลอกลิงก์ด้านล่างนี้เพื่อไปวางใช้งานบนบราวเซอร์ได้โดยตรง</p>
    <p style="margin: 0;">
      <a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_permalink($post_id); ?>?action=manage</a>
    </p>
    <p>
      จึงเรียนมาเพื่อทราบ<BR>
      PT Enterprise Portal
    </p>
    <?php
     $output_string = ob_get_contents();
      ob_end_clean();
      request_sentmail($er_mail,'Request Content: '.'['.$status.']'.' '.$reSubject.'',$output_string);
      // request_sentmail($er_mail,'[อนุมัติคำร้องขอ User] เรื่อง: '.get_the_title($current_post_id),$output_string );
    ?>
<?php } ?>

<?php ob_start(); ?>
<h3>เรียน <?php echo $user_submit->first_name.' '.$user_submit->last_name; ?></h3>
<table width="350px" style="border: solid 1px #000;border-collapse: collapse;}">
  <thead>
    <tr>
      <td style="background:#8acd56;border: solid 1px #000;padding: 3px 5px;" colspan="2">คำร้องประกาศ : <?php echo $post_id; ?></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">ผู้ยื่นคำรอง</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo $user_submit->first_name.' '.$user_submit->last_name; ?></td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">วันที่ส่งคำร้อง</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_the_date('d/m/Y',$post_id); ?></td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">เรื่อง</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_field('reSubject',$post_id); ?></td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">สถานะ</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;">
        <?php
          $field = get_field_object( 'reStatus', $post_id);
          $status = $field['value'][ 'label' ];
          echo $status;
         ?>
     </td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">หมวดหมู่</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;">
        <?php
          $field = get_field_object( 'reCat', $post_id);
          $label = $field['value'][ 'label' ];
          echo $label;
         ?>
     </td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">วัตถุประสงค์</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_field('reObj',$post_id); ?></td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">รายละเอียด</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo get_field('reDetail',$post_id); ?></td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">วันที่ต้องการประชาสัมพันธ์</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php echo yp_thai_year(get_field('reDate_start',$post_id)).' - '.yp_thai_year(get_field('reDate_end',$post_id)); ?></td>
    </tr>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">ช่องทางการสื่อสาร</td>
      <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;"><?php $reChannel2 = get_field_object('reChannel',$post_id)['value'];  echo implode(', ', array_column($reChannel2, 'label')); ?></td>
    </tr>

    <?php if (get_field('file_work',$post_id)): ?>
      <tr>
        <td style="background:#8bce94;border: solid 1px #000;border-bottom:0;padding: 3px 5px;" width="50%">ไฟล์แนบ</td>
        <td width="50%" style="border: solid 1px #000;border-bottom:0;padding: 3px 5px;">
          <a target="_blank" class="view-work" href="<?php echo get_field('file_work',$post_id); ?>">ดูไฟล์งาน</a>
        </td>
      </tr>
    <?php endif; ?>
    <tr>
      <td style="background:#8bce94;border: solid 1px #000;padding: 3px 5px;" width="50%">ลิงก์คำร้องประกาศ</td>
      <td width="50%" style="border: solid 1px #000;padding: 3px 5px;"><a href="<?php echo get_the_permalink($post_id); ?>">รายละเอียดคำร้องประกาศ</a></td>
    </tr>
  </tbody>
</table>
<br>
<p style="margin: 0;">หากคุณไม่สามารถเข้าลิงก์ รายละเอียดคำร้องประกาศ คุณสามารถคัดลอกลิงก์ด้านล่างนี้เพื่อไปวางใช้งานบนบราวเซอร์ได้โดยตรง</p>
<p style="margin: 0;">
  <a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_permalink($post_id); ?></a>
</p>
<p>
  จึงเรียนมาเพื่อทราบ<BR>
  PT Enterprise Portal
</p>
<?php
$output_string = ob_get_contents();
 ob_end_clean();
 request_sentmail($user_submit->user_email,'Request Content: '.'[คำร้องของคุณอนุมัติแล้ว]'.' '.$reSubject.'',$output_string);
 ?>

<?php
  if ($reDetailUser == '') {
    $reDetailUser = "อนุมัติคำร้องขอ User";
  }
  $row = array(
   's1_uid' => $username->user_login,
   's1_comment' => $reDetailUser,
   'create_at' => $created_at
  );
  $add_comment = add_row( 'comment_s1', $row ,$current_post_id);



  wp_send_json_success([
     'result' => [
         'redirectUrl' => get_the_permalink($current_post_id),
         'message' => 'ส่งข้อมูลสำเร็จ'
     ]
  ]);

 ?>
