<?php
/**
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fluffy
 */

 header_fuc();


 $current_user_id = get_current_user_id();
 $user_data = get_userdata($current_user_id);
 $er_users_list = get_field('er_users_list','option');

 $match = '';
 foreach ($er_users_list as $value) {
   // print_r($value);
   if ($value['group_email']['ID'] == $current_user_id) {
     $match = 1;
   }
 }

 ?>


 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

 	<div class="entry-content">

      <main id="primary" class="site-main">
        <!-- <script type="text/javascript">
          jQuery(document).ready(function($) {
            setTimeout(function () {
                alert();
                $('.reDate_start,.reDate_end').attr('autocomplete', 'off');
            }, 300);
          });
        </script> -->
       <link id="pagestyle" href="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />
       <style media="screen">
       h4, .h4, .h4, h5, .h5, .h5, h6, .h6, .h6 {
        font-weight: 500!important;
        }
         .flatpickr-calendar .flatpickr-day.today {
            background: #00ab4e !important;
        }
        .wrap-submit {
              display: flex;
              align-items: center;
                  gap: 15px;
          }
          .wrap-submit img {
                max-width: 24px;
            }
            .wrap-button-reStatus button:first-child {
              display: none;
            }
            .wrap-button-reStatus {
                  display: flex;
                  gap: 10px;
              }
              .wrap-button-reStatus button {
    padding: 8px 5px;
    font-size: 14px;
    width: 100%;
    border: 0;
    color: #000;
    border-radius: 5px;
}
.wrap-button-reStatus button.active {
    background: #e12b6b;
    color: #FFF;
}
       </style>
      <div class="main-content request-box position-relative bg-gray-100 h-100 kanit-font">

           <div class="container-fluid v-container">
             <section class="py-3">
               <div class="row mb-4 mb-md-0">
                 <div class="col-md-8 me-auto my-auto text-left">

                   <?php
                    if ($user_data->user_login == get_field('manager_userid')): ?>
                    <h2>จัดการคำร้องที่ส่งเข้ามา</h2>
                    <p>คุณสามารถจัดการคำร้องของผู้อยู่ใต้บังคับบัญชาที่ที่นี่</p>
                     <?php else: ?>
                       <h2>ระบบจัดการคำร้องประกาศ</h2>
                       <p>คุณสามารถจัดการคำร้องและสามารถส่งคำร้องประกาศของคุณได้ด้วยตนเอง</p>
                   <?php endif; ?>
                 </div>
                 <div class="col-lg-4 col-md-12 my-auto text-end">
                    <?php
                     if ($user_data->user_login == get_field('manager_userid')): ?>
                     <a type="button" href="<?php echo home_url('/request-manage'); ?>" class="add-request btn bg-gradient-primary mb-0 mt-0 mt-md-n9 mt-lg-0">
                       <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="15 18 9 12 15 6"></polyline></svg>
                       ย้อนกลับ
                     </a>
                   <?php elseif ($match == 1): ?>

                      <?php else: ?>
                        <a type="button" href="<?php echo home_url('/request-contents'); ?>" class="add-request btn bg-gradient-primary mb-0 mt-0 mt-md-n9 mt-lg-0">
                          <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="15 18 9 12 15 6"></polyline></svg>
                          ย้อนกลับ
                        </a>
                    <?php endif; ?>

                 </div>
               </div>
               <div class="row mt-lg-4 mt-2">
               <?php
                    require('request-content/view.php');
                 ?>
               </div>
             </section>

           </div>
         </div>

         <!--   Core JS Files   -->
         <script src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/js/core/popper.min.js"></script>
         <script src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/js/core/bootstrap.min.js"></script>
         <script src="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/js/material-dashboard.min.js?v=3.0.5"></script>

    	</main><!-- #main -->

 		</div>
 	</div><!-- .entry-content -->

 </article><!-- #post-<?php the_ID(); ?> -->



 <?php
 // get_sidebar();
 footer_fuc();
