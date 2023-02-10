<style media="screen">
.bottom-footer p {
  margin-bottom: 0!important;
}
.file_work span.rea_s {
    display: inline;
    color: #f56c6c;
}
</style>
<div class="col-md-8">

  <div class="card">
      <div class="card-body p-4">
        <div class="d-flex mt-n2">
          <div class="my-autox">
             <h4 class="mb-0"><?php the_title(); ?></h4>
          </div>
        </div>
        <p class="text-smreObj">
                <?php echo get_field('reObj'); ?>
        <hr class="horizontal dark">
        <div class="user_form">
            <?php
            if (get_current_blog_id() == 1) {
              echo do_shortcode('[fluentform id="10"]');
            }
            else {
              echo do_shortcode('[fluentform id="4"]');
            }
            ?>

        <?php if (get_field('file_work')): ?>
          <a target="_blank" class="view-work" href="<?php echo get_field('file_work'); ?>">ดูไฟล์งาน</a>
        <?php endif; ?>
        </div>

        <hr class="horizontal dark">
        <div class="row">
          <div class="col-8">
            <h6 class="text-sm mb-0 cate-text">
              <?php echo get_field('reStatus')['label']; ?>
            </h6>
            <p class="text-secondary text-sm font-weight-normal mb-0">สถานะ</p>
          </div>
          <div class="col-4 text-end">
            <h6 class="text-sm mb-0"><?php echo get_the_date(); ?></h6>
            <p class="text-secondary text-sm font-weight-normal mb-0">วันที่ส่งคำร้อง</p>
          </div>
        </div>
      </div>
    </div>


</div>

<div class="col-md-4">
  <div class="card">
      <div class="card-body p-4">
        <h4>Comment</h4>
        <ul class="order_notes">
        <?php
        // get repeater field data
      $repeater = get_field('comment_s1');
      // vars
      $order = array();
      // populate order
      foreach( $repeater as $i => $row ) {
      	$order[ $i ] = $row['create_at'];
      }

      if (!empty($repeater)) {
        array_multisort( $order, SORT_DESC, $repeater );
      }

      if (!empty($repeater)) {
       foreach ($repeater as  $value) {
          $s1_comment = $value['s1_comment'];
          $s1_uid  = $value['s1_uid'];
          $create_at  = $value['create_at'];
          $data_thai = date_i18n("j F Y เวลา H:i", strtotime($create_at));
          $created_at  =  date("d-m-Y H:i:s", strtotime($create_at));

          $user = get_user_by('login', $s1_uid);
          $comment_user_id =   $user->ID;
          ?>
          <li class="note <?php if ($comment_user_id == get_field('reuser_id')) { echo "user-note"; } else { echo "system-note";  } ?>">
              <div class="note_content">
                <p><?php
                $html = wp_strip_all_tags($s1_comment);
                if (empty($html)) {
                echo "** ไม่รองรับ HTML<BR>ห้ามใส่ HTML Code ใน Comment**";
                }
                else {
                  echo $html;
                }
                ?></p>
              </div>
              <p class="meta">
                <abbr class="exact-date" title="<?php echo $created_at; ?>">
                <?php echo $data_thai; ?>
                by <?php $user = get_user_by('login', $s1_uid); echo $user->first_name; ?>
              </abbr>

              </p>
          </li>
      <?php } ?>
        <?php
      }
      else {
      ?>
      <li class="note system-note">
          <div class="note_content no_comment">
            <p>ยังไม่มีคอมเม้น</p>
          </div>
      </li>
    <?php } ?>

      </ul>

      <style media="screen">
        .btn_add_comment{
          display: none;
        }
        .btn_add_comment.active{
          display: block;
        }
      </style>
       <script type="text/javascript">
          jQuery(document).ready(function($) {
            $('.single-vc_request_content .reDetail').attr('readonly',true);
            $('.add_comment_in').keyup(function(event) {
              $('.reDetailUser textarea').val($(this).val());
            });

            $('.wrap-button-reStatus button').click(function(event) {
               $('.wrap-button-reStatus button').removeClass('active');
               $('.btn_add_comment').removeClass('active');
               $(this).toggleClass('active');
               $('.btn_add_comment').toggleClass('active');
               $('input[name="reStatus"]').val($(this).attr('data-value'));
            });

            $('.btn_add_comment').click(function(event) {
              $('.comment_loader').removeClass('hide');
              $('.form-request .ff-btn-submit').trigger('click');
            });
          });
       </script>

       <!-- <option value="status_02" <php if (get_field('reStatus')['value'] == 'status_02') { echo 'selected'; } ?>>หัวหน้างานส่งกลับให้แก้ไข</option>
       <option value="status_03 <php if (get_field('reStatus')['value'] == 'status_03') { echo 'selected'; } ?>">รอหัวหน้างานอนุมัติคำร้องแก้ไข</option>
       <option value="status_04 <php if (get_field('reStatus')['value'] == 'status_04') { echo 'selected'; } ?>">หัวหน้างานอนุมัติแล้ว</option>
       <option value="status_05 <php if (get_field('reStatus')['value'] == 'status_05') { echo 'selected'; } ?>">ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ</option>
       <option value="status_06 <php if (get_field('reStatus')['value'] == 'status_06') { echo 'selected'; } ?>">ER กำลังแก้ไขข้อมูล</option>
       <option value="status_07 <php if (get_field('reStatus')['value'] == 'status_07') { echo 'selected'; } ?>">ผู้ทำคำร้องยืนยันเรียบร้อยแล้ว</option>
       <option value="status_08 <php if (get_field('reStatus')['value'] == 'status_08') { echo 'selected'; } ?>">ประกาศแล้ว</option>
       <option value="status_09 <php if (get_field('reStatus')['value'] == 'status_09') { echo 'selected'; } ?>">ไม่อนุมัติ</option> -->

       <div class="add_comment_box">
         <div class="form-wrap status">
           <label for="reStatus">สถานะ</label>
           <div class="wrap-button-reStatus">

             <?php if (get_field('reStatus')['value'] == 'status_01'): ?>
               <button data-value="status_01" class="<?php if (get_field('reStatus')['value'] == 'status_01') { echo 'selected'; } ?>">รอหัวหน้างานอนุมัติ</button>
               <button data-value="status_02" class="<?php if (get_field('reStatus')['value'] == 'status_02') { echo 'selected'; } ?>">หัวหน้างานส่งกลับให้แก้ไข</button>
               <button data-value="status_04" class="<?php if (get_field('reStatus')['value'] == 'status_04') { echo 'selected'; } ?>">หัวหน้างานอนุมัติแล้ว</button>
               <button data-value="status_09" class="<?php if (get_field('reStatus')['value'] == 'status_09') { echo 'selected'; } ?>">ไม่อนุมัติ</button>
             <?php endif; ?>

              <?php if (get_field('reStatus')['value'] == 'status_02'): ?>
                <button data-value="status_02" class="<?php if (get_field('reStatus')['value'] == 'status_02') { echo 'selected'; } ?>">หัวหน้างานส่งกลับให้แก้ไข</button>
                <button data-value="status_03" class="<?php if (get_field('reStatus')['value'] == 'status_03') { echo 'selected'; } ?>">รอหัวหน้างานอนุมัติคำร้องแก้ไข</button>
              <?php endif; ?>

              <!-- รอหัวหน้างานอนุมัติคำร้องแก้ไข -->
              <?php if (get_field('reStatus')['value'] == 'status_03'): ?>
                <button data-value="status_03" class="<?php if (get_field('reStatus')['value'] == 'status_03') { echo 'selected'; } ?>">รอหัวหน้างานอนุมัติคำร้องแก้ไข</button>
                <button data-value="status_02" class="<?php if (get_field('reStatus')['value'] == 'status_02') { echo 'selected'; } ?>">หัวหน้างานส่งกลับให้แก้ไข</button>
                <button data-value="status_04" class="<?php if (get_field('reStatus')['value'] == 'status_04') { echo 'selected'; } ?>">หัวหน้างานอนุมัติแล้ว</button>
              <?php endif; ?>

              <!-- หัวหน้างานอนุมัติแล้ว -->
              <?php
               if (get_field('reStatus')['value'] == 'status_04'): ?>
                <button data-value="status_04" class="<?php if (get_field('reStatus')['value'] == 'status_04') { echo 'selected'; } ?>">หัวหน้างานอนุมัติแล้ว</button>
                <button data-value="status_05" class="<?php if (get_field('reStatus')['value'] == 'status_05') { echo 'selected'; } ?>">ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ</button>
                <?php if (empty(get_field('reStatus_extra'))): ?>
                  <button data-value="status_08" class="<?php if (get_field('reStatus')['value'] == 'status_08') { echo 'selected'; } ?>">ประกาศแล้ว</button>
                <?php endif; ?>
              <?php endif; ?>

              <!-- ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ -->
              <?php if (get_field('reStatus')['value'] == 'status_05'): ?>
                <button data-value="status_05" class="<?php if (get_field('reStatus')['value'] == 'status_05') { echo 'selected'; } ?>">ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ</button>
                <button data-value="status_07" class="<?php if (get_field('reStatus')['value'] == 'status_07') { echo 'selected'; } ?>">ผู้ทำคำร้องยืนยันเรียบร้อยแล้ว</button>
                <button data-value="status_06" class="<?php if (get_field('reStatus')['value'] == 'status_06') { echo 'selected'; } ?>">ผู้ทำคำร้องส่งกลับให้ ER แก้ไข</button>
              <?php endif; ?>

              <?php if (get_field('reStatus')['value'] == 'status_06'): ?>
                <button data-value="status_06" class="<?php if (get_field('reStatus')['value'] == 'status_06') { echo 'selected'; } ?>">ผู้ทำคำร้องส่งกลับให้ ER แก้ไข</button>
                <button data-value="status_05" class="<?php if (get_field('reStatus')['value'] == 'status_05') { echo 'selected'; } ?>">ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ</button>
              <?php endif; ?>

              <?php if (get_field('reStatus')['value'] == 'status_07'): ?>
                <button data-value="status_07" class="<?php if (get_field('reStatus')['value'] == 'status_07') { echo 'selected'; } ?>">ผู้ทำคำร้องยืนยันเรียบร้อยแล้ว</button>
                <button data-value="status_08" class="<?php if (get_field('reStatus')['value'] == 'status_08') { echo 'selected'; } ?>">ประกาศแล้ว</button>
              <?php endif; ?>

           </div>


           <select id="reStatus" class="hide">
             <?php if (get_field('reStatus')['value'] == 'status_01'): ?>
               <option value="status_01" <?php if (get_field('reStatus')['value'] == 'status_01') { echo 'selected'; } ?>>รอหัวหน้างานอนุมัติ</option>
               <option value="status_02" <?php if (get_field('reStatus')['value'] == 'status_02') { echo 'selected'; } ?>>หัวหน้างานส่งกลับให้แก้ไข</option>
               <option value="status_04" <?php if (get_field('reStatus')['value'] == 'status_04') { echo 'selected'; } ?>>หัวหน้างานอนุมัติแล้ว</option>
               <option value="status_09" <?php if (get_field('reStatus')['value'] == 'status_09') { echo 'selected'; } ?>>ไม่อนุมัติ</option>
             <?php endif; ?>

              <?php if (get_field('reStatus')['value'] == 'status_02'): ?>
                <option value="status_02" <?php if (get_field('reStatus')['value'] == 'status_02') { echo 'selected'; } ?>>หัวหน้างานส่งกลับให้แก้ไข</option>
                <option value="status_03" <?php if (get_field('reStatus')['value'] == 'status_03') { echo 'selected'; } ?>>รอหัวหน้างานอนุมัติคำร้องแก้ไข</option>
              <?php endif; ?>

              <!-- รอหัวหน้างานอนุมัติคำร้องแก้ไข -->
              <?php if (get_field('reStatus')['value'] == 'status_03'): ?>
                <option value="status_03" <?php if (get_field('reStatus')['value'] == 'status_03') { echo 'selected'; } ?>>รอหัวหน้างานอนุมัติคำร้องแก้ไข</option>
                <option value="status_02" <?php if (get_field('reStatus')['value'] == 'status_02') { echo 'selected'; } ?>>หัวหน้างานส่งกลับให้แก้ไข</option>
                <option value="status_04" <?php if (get_field('reStatus')['value'] == 'status_04') { echo 'selected'; } ?>>หัวหน้างานอนุมัติแล้ว</option>
              <?php endif; ?>

              <!-- หัวหน้างานอนุมัติแล้ว -->
              <?php if (get_field('reStatus')['value'] == 'status_04'): ?>
                <option value="status_04" <?php if (get_field('reStatus')['value'] == 'status_04') { echo 'selected'; } ?>>หัวหน้างานอนุมัติแล้ว</option>
                <option value="status_05" <?php if (get_field('reStatus')['value'] == 'status_05') { echo 'selected'; } ?>>ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ</option>
                <?php if (empty(get_field('reStatus_extra'))): ?>
                  <option value="status_08" <?php if (get_field('reStatus')['value'] == 'status_08') { echo 'selected'; } ?>>ประกาศแล้ว</option>
                <?php endif; ?>
              <?php endif; ?>

              <!-- ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ -->
              <?php if (get_field('reStatus')['value'] == 'status_05'): ?>
                <option value="status_05" <?php if (get_field('reStatus')['value'] == 'status_05') { echo 'selected'; } ?>>ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ</option>
                <option value="status_07" <?php if (get_field('reStatus')['value'] == 'status_07') { echo 'selected'; } ?>>ผู้ทำคำร้องยืนยันเรียบร้อยแล้ว</option>
                <option value="status_06" <?php if (get_field('reStatus')['value'] == 'status_06') { echo 'selected'; } ?>>ผู้ทำคำร้องส่งกลับให้ ER แก้ไข</option>
              <?php endif; ?>

              <?php if (get_field('reStatus')['value'] == 'status_06'): ?>
                <option value="status_06" <?php if (get_field('reStatus')['value'] == 'status_06') { echo 'selected'; } ?>>ผู้ทำคำร้องส่งกลับให้ ER แก้ไข</option>
                <option value="status_05" <?php if (get_field('reStatus')['value'] == 'status_05') { echo 'selected'; } ?>>ER ส่งงานให้ผู้ทำคำร้องตรวจสอบ</option>
              <?php endif; ?>

              <?php if (get_field('reStatus')['value'] == 'status_07'): ?>
                <option value="status_07" <?php if (get_field('reStatus')['value'] == 'status_07') { echo 'selected'; } ?>>ผู้ทำคำร้องยืนยันเรียบร้อยแล้ว</option>
                <option value="status_08" <?php if (get_field('reStatus')['value'] == 'status_08') { echo 'selected'; } ?>>ประกาศแล้ว</option>
              <?php endif; ?>
            </select>


         </div>


         <style media="screen">
         .single-vc_request_content #page .er_box.ff_cond_v
          {
              display: block!important;
          }
          .single-vc_request_content .choices__inner {
              background: #eee!important;
          }
         </style>
         <?php
         if (get_field('reStatus')['value'] == 'status_02' && $user_data->ID == get_field('reuser_id') || get_field('reStatus')['value'] == 'status_06' && $match == 1): ?>
             <style media="screen">
             .single-vc_request_content .wrap_submit,
             .single-vc_request_content .reDetailUser.hide
             {
                 display: none!important;
             }

             .single-vc_request_content .file_work,
             .single-vc_request_content .form-wrap.status,
            .single-vc_request_content #page .er_box.ff_cond_v
             {
                 display: block!important;
             }
             .readonly, .single-vc_request_content .readonly-single,
             .single-vc_request_content .reDetail {
                    pointer-events: auto;
                    background: #fff;
                }
                .single-vc_request_content .choices__inner {
                    background: #fff!important;
                }
             </style>

             <script src='<?php echo site_url(); ?>/wp-includes/js/jquery/jquery.min.js' id='jquery-core-js2'></script>
             <link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/css/flatpickr.min.css">
             <script src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/js/flatpickr.js"></script>

             <script src="<?php echo get_template_directory_uri(); ?>/request-content/config-date.js"></script>

             <script type="text/javascript">
               jQuery(document).ready(function($) {
                   $('.single-vc_request_content .reDetail').attr('readonly',false);

                 function get_next_week_start() {
                    var now = new Date();
                    var next_week_start = new Date(now.getFullYear(), now.getMonth(), now.getDate()+(8 - now.getDay()));
                    return next_week_start;
                 }

                 const dateString = get_next_week_start(new Date());
                 const D = new Date(dateString);

                 var minD = D.getFullYear()+'-'+(D.getMonth() +1)+'-'+D.getDate();

                 var data = "<?php echo get_field('reCat')['value']; ?>";

                 if (data == 'cat_01' || data == 'cat_02') {

                   $(".reDate_start").flatpickr({
                       // minDate: new Date(),
                       minDate: minD,
                       disable : [
                        function(date) {
                            return ( date.getDay() != 1 );
                        }
                      ],
                        locale: {
                            firstDayOfWeek : 1 // start week on Monday
                        },
                       enableTime: false,
                       allowInput: true,
                       // altInput: true,
                       dateFormat: "d-m-Y"
                   });

                 }

                 else if (data == 'cat_03' || data == 'cat_04') {

                   $(".reDate_start").flatpickr({
                       // minDate: new Date(),
                       minDate: minD,
                       disable : [
                        function(date) {
                            return ( date.getDay() != 2 );
                        }
                      ],
                        locale: {
                            firstDayOfWeek : 1 // start week on Monday
                        },
                       enableTime: false,
                       allowInput: true,
                       // altInput: true,
                       dateFormat: "d-m-Y"
                   });

                 }

                 else if  (data == 'cat_05' || data == 'cat_06') {

                   $(".reDate_start").flatpickr({
                       // minDate: new Date(),
                       minDate: minD,
                       disable : [
                        function(date) {
                            return ( date.getDay() != 4 );
                        }
                      ],
                        locale: {
                            firstDayOfWeek : 1 // start week on Monday
                        },
                       enableTime: false,
                       allowInput: true,
                       // altInput: true,
                       dateFormat: "d-m-Y"
                   });

                 }
                 else {

                   $(".reDate_start").flatpickr({
                       // minDate: new Date(),
                       minDate: minD,
                       disable : [
                        function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);
                        }
                      ],
                        locale: {
                            firstDayOfWeek : 1 // start week on Monday
                        },
                       enableTime: false,
                       allowInput: true,
                       // altInput: true,
                       dateFormat: "d-m-Y"
                   });


                 }

               });
             </script>
           <?php endif; ?>




<?php if (get_field('reStatus')['value'] == 'status_04' && $match == 1): ?>
    <style media="screen">
    .single-vc_request_content #page .file_work
    {
        display: block!important;
    }
    </style>
<?php endif; ?>


         <?php if (get_field('reStatus')['value'] == 'status_02' && $user_data->user_login == get_field('manager_userid')): ?>
           <style media="screen">
           .single-vc_request_content .wrap_submit,
           .single-vc_request_content .reDetailUser.hide,
           .single-vc_request_content .file_work,
           .single-vc_request_content .form-wrap.status{
               display: none!important;
           }
           </style>
         <?php elseif (get_field('reStatus')['value'] == 'status_01' && $user_data->user_login != get_field('manager_userid')): ?>
             <style media="screen">
             .single-vc_request_content .wrap_submit,
             .single-vc_request_content .reDetailUser.hide,
             .single-vc_request_content .file_work,
             .single-vc_request_content .form-wrap.status{
                 display: none!important;
             }
             </style>
           <?php elseif (get_field('reStatus')['value'] == 'status_03' && $user_data->user_login != get_field('manager_userid')): ?>
               <style media="screen">
               .single-vc_request_content .wrap_submit,
               .single-vc_request_content .reDetailUser.hide,
               .single-vc_request_content .file_work,
               .single-vc_request_content .form-wrap.status{
                   display: none!important;
               }
               </style>
             <?php elseif (get_field('reStatus')['value'] == 'status_04' && $match != 1): ?>
                 <style media="screen">
                 .single-vc_request_content .wrap_submit,
                 .single-vc_request_content .reDetailUser.hide,
                 .single-vc_request_content .file_work,
                 .single-vc_request_content .form-wrap.status{
                     display: none!important;
                 }
                 </style>
         <?php elseif (get_field('reStatus')['value'] == 'status_05' && $match == 1): ?>
             <style media="screen">
             .single-vc_request_content .wrap_submit,
             .single-vc_request_content .reDetailUser.hide,
             .single-vc_request_content .file_work,
             .single-vc_request_content .form-wrap.status{
                 display: none!important;
             }
             </style>
           <?php elseif (get_field('reStatus')['value'] == 'status_06' && $match != 1): ?>
               <style media="screen">
               .single-vc_request_content .wrap_submit,
               .single-vc_request_content .reDetailUser.hide,
               .single-vc_request_content .file_work,
               .single-vc_request_content .form-wrap.status{
                   display: none!important;
               }
               </style>
             <?php elseif (get_field('reStatus')['value'] == 'status_07' && $match != 1): ?>
                 <style media="screen">
                 .single-vc_request_content .wrap_submit,
                 .single-vc_request_content .reDetailUser.hide,
                 .single-vc_request_content .file_work,
                 .single-vc_request_content .form-wrap.status{
                     display: none!important;
                 }
                 </style>
               <?php elseif (get_field('reStatus')['value'] == 'status_08'): ?>
                   <style media="screen">
                   .single-vc_request_content .wrap_submit,
                   .single-vc_request_content .reDetailUser.hide,
                   .single-vc_request_content .file_work,
                   .single-vc_request_content .form-wrap.status{
                       display: none!important;
                   }
                   </style>
               <?php elseif (get_field('reStatus')['value'] == 'status_09' && $user_data->user_login != get_field('manager_userid')): ?>
                   <style media="screen">
                   .single-vc_request_content .wrap_submit,
                   .single-vc_request_content .reDetailUser.hide,
                   .single-vc_request_content .file_work,
                   .single-vc_request_content .form-wrap.status{
                       display: none!important;
                   }
                   </style>
           <?php else: ?>
             <div class="form-wrap">
               <label for="add_comment_in">เพิ่มความเห็น</label>
               <textarea name="add_comment_in" class="add_comment_in" rows="8" cols="80"></textarea>
             </div>

             <div class="wrap-submit">
               <button type="button" class="btn_add_comment">บันทึก</button>
               <div class="comment_loader hide">
                 <img src="<?php echo YP_DIRECTORY_URL; ?>/report/loader.gif" alt="loading">
               </div>
             </div>


         <?php endif; ?>


       </div>


      </div>
  </div>
</div>
