<?php
/**
 * Template name: Page Request
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

 	<?php if (!is_front_page() && !is_elementor()): ?>
   <?php v_page_title(); ?>
 	<?php endif; ?>
 <div class="page wrap-bg<?php if ( is_elementor() ) { echo 'e'; } ?>">
 	<div class="entry-content">
      <main id="primary" class="site-main">

       <link id="pagestyle" href="<?php echo site_url(); ?>/wp-content/plugins/yp-plugin-core/report/dashboard-assets/assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />

      <div class="main-content request-box position-relative bg-gray-100 h-100">

           <div class="container-fluid v-container py-4">
             <section class="py-3">
               <div class="row mb-4 mb-md-0">
                 <div class="col-md-8 me-auto my-auto text-left">
                   <h2>ระบบจัดการคำร้องประกาศ</h2>
                   <p>คุณสามารถจัดการคำร้องและสามารถเพิ่มคำร้องประกาศของคุณได้ด้วยตนเอง</p>
                 </div>
                 <div class="col-lg-4 col-md-12 my-auto text-end">
                   <?php if ($_GET['action'] == ""): ?>
                     <a type="button" href="?action=add" class="add-request btn bg-gradient-primary mb-0 mt-0 mt-md-n9 mt-lg-0">
                       <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                       เพิ่มคำร้อง
                     </a>
                     <?php else: ?>
                       <div class="my-auto date_approved">
                         <a type="button" href="<?php echo home_url('/request-contents'); ?>" class="add-request btn bg-gradient-primary mb-0 mt-0 mt-md-n9 mt-lg-0">
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
                        require('request-content/all.php');
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

<style media="screen">
.flatpickr-calendar .flatpickr-day.selected {
  background-color: #00ab4e!important;
}
</style>

 <?php
 // get_sidebar();
 footer_fuc();
