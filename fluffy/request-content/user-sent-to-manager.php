<?php
            $user = get_user_by('login', get_field('manager_userid',$current_post_id));
            $post_id = $current_post_id;
            $manager_email = $user->user_email;
            $user_submit = get_user_by('ID', get_field('reuser_id',$post_id));
            update_field('reStatus','status_03',$current_post_id);
            ob_start();
            ?>
            <?php
            $reSubject = get_field('reSubject',$post_id);
            ?>
            <h3>เรียน <?php echo $user->first_name.' '.$user->last_name; ?></h3>
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
                  <td width="50%" style="border: solid 1px #000;padding: 3px 5px;"><a href="<?php echo get_the_permalink($post_id); ?>?action=manage">จัดการคำร้องประกาศ</a></td>
                </tr>
              </tbody>
            </table>
            <br>
            <p style="margin: 0;">หากคุณไม่สามารถเข้าลิงก์ จัดการคำร้องประกาศ คุณสามารถคัดลอกลิงก์ด้านล่างนี้เพื่อไปวางใช้งานบนบราวเซอร์ได้โดยตรง</p>
            <p style="margin: 0;">
              <a href="<?php echo get_the_permalink($post_id); ?>?action=manage"><?php echo get_the_permalink($post_id); ?>?action=manage</a>
            </p>
            <p>
              จึงเรียนมาเพื่อทราบ<BR>
              PT Enterprise Portal
            </p>
            <?php
             $output_string = ob_get_contents();
             ob_end_clean();
             // request_sentmail($manager_email,'[ส่งเรื่องแก้ไขคำร้อง] เรื่อง: '.$reSubject,$output_string);
             request_sentmail($manager_email,'Request Content: '.'['.$status.']'.' '.$reSubject.'',$output_string);

             $data = array(
               'ID' => $current_post_id,
               'post_title' => $reSubject,
              );

             wp_update_post( $data );

              ////////////////////



              if ($reCat) {
                update_field('reCat',$reCat,$current_post_id);
              }

              if ($reSubject) {
                update_field('reSubject',$reSubject,$current_post_id);
              }

              if ($reObj) {
                update_field('reObj',$reObj,$current_post_id);
              }


              if ($reDate_start) {
                update_field('reDate_start',$reDate_start,$current_post_id);
              }

              if ($reDate_end) {
                update_field('reDate_end',$reDate_end,$current_post_id);
              }

              if ($reChannel) {
                update_field('reChannel',$reChannel,$current_post_id);
              }

              if ($er_box) {
                update_field('er_box',$er_box,$current_post_id);
              }

              if ($user_id) {
                update_field('reuser_id',$user_id,$current_post_id);
              }



              if ($reDetail) {
                update_field('reDetail',$reDetail,$current_post_id);
              }

              if ($file_work) {
                update_field('file_work',$file_work,$current_post_id);
              }



              $now = new DateTime();
              $created_at = $now->format('Y-m-d H:i:s');
              $username = get_userdata(get_current_user_id());
              if ($reDetailUser == '') {
                $reDetailUser = "ส่งเรื่องแก้ไขคำร้อง";
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
                     'message' => 'แก้ไขข้อมูลสำเร็จ'
                 ]
              ]);

 ?>
