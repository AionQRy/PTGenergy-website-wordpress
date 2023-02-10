<?php
/**
 * Template name: Page Request Manage
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
 ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

 <div class="page wrap-bg<?php if ( is_elementor() ) { echo 'e'; } ?>">
 	<div class="entry-content request-page">
      <main id="primary" class="site-main">

       <link id="pagestyle" href="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />

      <div class="main-content request-box position-relative bg-gray-100 h-100">

           <div class="container-fluid v-container py-4">
             <section class="py-3">
               <div class="row mb-4 mb-md-0">
                 <div class="col-md-8 me-auto my-auto text-left">
                   <h2>จัดการคำร้องที่ส่งเข้ามา</h2>
                   <p>คุณสามารถจัดการคำร้องของผู้อยู่ใต้บังคับบัญชาที่ที่นี่</p>
                 </div>
                 <div class="col-lg-4 col-md-12 my-auto text-end">
                   <?php if ($_GET['action'] == ""): ?>

                     <?php else: ?>
                       <div class="my-auto date_approved">
                         <a type="button" href="<?php echo home_url('/request-manage'); ?>" class="add-request btn bg-gradient-primary mb-0 mt-0 mt-md-n9 mt-lg-0">
                           <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="15 18 9 12 15 6"></polyline></svg>
                           ย้อนกลับ
                         </a>
                       </div>
                   <?php endif; ?>
                 </div>
               </div>
               <div class="row mt-lg-4 mt-2">
               <?php if ($_GET['action'] == 'add'):
                    require('request-content/add.php');
                    else:
                        require('request-content/all-manage.php');
                    endif;
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
