<?php
/**
 * template name: My Profile
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
  $image_url = get_wp_user_avatar($current_user_id, 300);
  // $curauth = get_userdata($current_user_id);
	$cover_profile = get_field('cover_profile','user_'.$current_user_id);
	$userdata = yp_user_data_api();
	$empId = $userdata->codEmpId;
	$work_started = date('d/m', strtotime($userdata->dteEmpMt));
	$work_started_y = date('Y', strtotime($userdata->dteEmpMt))+543;
	$work_started = $work_started.'/'.$work_started_y;

?>
<main id="primary" class="site-main author-page">
		<div class="wrap-author-page">
				<div class="wrap-cover">
						<?php if ($cover_profile['url']): ?>
								<img src="<?php echo $cover_profile['url']; ?>" alt="cover">
							<?php else: ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cover.jpg" alt="cover">
						<?php endif; ?>
						<button type="button" class="edit_cover"><img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/img/edit.svg" alt="edit_cover"></button>
				</div>
				<div class="wrap-profile-info">
          <div class="edit-box-top">
            <a target="_blank" href="<?php echo site_url(); ?>/?edit_profile=1"><img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/img/edit.svg" alt="edit"></a>
          </div>
					<div class="left">
						<div class="avatar">
							<?php echo $image_url; ?>
						</div>
						<div class="info">
							<div class="name">
								<h2><?php echo $userdata->nameFirstT; ?> <?php echo $userdata->nameLastT; ?></h2>
                <?php if ($userdata->nameCentTha): ?>
                  <div class="deport">
                    <?php  echo $userdata->nameCentTha; ?>
                  </div>
                <?php endif; ?>
							</div>
							<div class="details">
								<p><strong>รหัสผนักงาน</strong> : <?php if (get_field('empid','user_'.$current_user_id)) {  echo get_field('empid','user_'.$current_user_id);  }//str_pad($current_user_id, 5, '0', STR_PAD_LEFT); ?></p>
								<p><strong>อีเมล</strong> : <?php if (!empty($userdata->email)) { echo $userdata->email; } else { echo $userdata->emailPerson; } ?></p>
								<p><strong>วันที่เริ่มงาน</strong> : <?php if (!empty($work_started)) { echo $work_started; } else { echo "-"; } ?></p>
								<p><strong>ตำแหน่ง</strong> : <?php if ($userdata->namePosT != '') { echo $userdata->namePosT; } else { echo "-"; } ?></p>
								<p><strong>Functional Title</strong> : <?php if ($userdata->jobNamt != '') { echo $userdata->jobNamt; } else { echo "-"; } ?></p>
								<p><strong>Level</strong> : <?php if ($userdata->numLvl != '') { echo $userdata->numLvl; } else { echo "-"; } ?></p>
								<p><strong>ฝ่าย</strong> : <?php if ($userdata->departmentName != '') { echo $userdata->departmentName; } else { echo "-"; } ?></p>
							</div>
						</div>
					</div>
					<div class="right">
            <div class="edit-box">
              <a target="_blank" href="<?php echo site_url(); ?>/?edit_profile=1"><img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/img/edit.svg" alt="edit"></a>
            </div>
						<div class="google-box">
              <div class="item-g drive">
                    <a href="https://drive.google.com/"><img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/img/drive.png" alt="drive"></a>
              </div>
              <div class="item-g gmail">
                    <a href="https://mail.google.com/"><img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/img/gmail.png" alt="gmail"></a>
              </div>
              <div class="item-g calendar">
                    <a href="https://calendar.google.com/"><img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/img/calendar.png" alt="calendar"></a>
              </div>
						</div>
					</div>
				</div>


        <div class="profile-content">
					<div class="fixed-content">
						<div class="job_grid-wrapper">
							<?php echo do_shortcode('[news_most_view]'); ?>
						</div>
					</div>
          <?php
          $profile_template_id = get_field('profile_template_id','user_'.get_current_user_id());
          if ($profile_template_id) {

            $contentElementor = "";
            if (class_exists("\\Elementor\\Plugin")) {
                $post_ID = 124;
                $pluginElementor = \Elementor\Plugin::instance();
                $contentElementor = $pluginElementor->frontend->get_builder_content($profile_template_id);
            }

            echo $contentElementor;
          }
          ?>
        </div>

		</div>

	</main><!-- #main -->

	<div class="edit_cover_input">
		<div class="ec_close">
			<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
		</div>
  	<div class="ob1">
  		  <h6>แก้ไขภาพปก</h6>
  	</div>
		<div class="ob2">
				<form class="wrap_coverinput" action="" enctype="multipart/form-data" method="post">
					<label for="cover_input">
						<?php if ($cover_profile['url']): ?>
								<img src="<?php echo $cover_profile['url']; ?>" id="thumb_preview" alt="thumb">
							<?php else: ?>
								<img src="<?php echo site_url(); ?>/wp-content/themes/fluffy/img/thumb.jpg" id="thumb_preview" alt="thumb">
						<?php endif; ?>
					</label>
					<input type="file" oninput="thumb_preview.src=window.URL.createObjectURL(this.files[0])" name="cover_input" id="cover_input">
					<small>ขนาดแนะนำ 1080x270px</small>
					<input type="hidden" name="chk_cover_input" value="1">
					<button type="submit" name="button" class="cover_save">บันทึก</button>
				</form>
		</div>
  </div>

<?php
// get_sidebar();
footer_fuc();
