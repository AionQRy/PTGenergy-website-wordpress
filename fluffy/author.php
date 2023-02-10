<?php
/**
 * The template for displaying all pages
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
	global $wp_query;
	$curauth = $wp_query->get_queried_object();
  $image_url = get_wp_user_avatar($curauth->ID, 300);
?>

	<main id="primary" class="site-main">

		<div class="wrap-author-page">
				<div class="wrap-cover">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cover.jpg" alt="cover">
				</div>
				<div class="wrap-profile-info">
					<div class="left">
						<div class="avatar">
							<?php echo $image_url; ?>
						</div>
						<div class="info">
							<div class="name">
								<h2><?php echo $curauth->user_firstname; ?> <?php echo $curauth->user_lastname; ?></h2>
							</div>
							<div class="details">
								<p><strong>รหัสผนักงาน</strong> : U<?php echo str_pad($curauth->ID, 5, '0', STR_PAD_LEFT); ?></p>
								<p><strong>อีเมล</strong> : <?php echo $curauth->user_email; ?></p>
								<p><strong>วันที่เริ่มงาน</strong> : 1 ก.ค 2564  อายุงาน : 1 ปี</p>
								<p><strong>ฝ่าย</strong> : ดูและระบบ</p>
							</div>
						</div>
					</div>
					<div class="right">
						<div class="google-box">

						</div>
					</div>
				</div>
				<div class="wrap-author-content">
						<?php echo do_shortcode('[complaint_box]'); ?>
				</div>
		</div>

	</main><!-- #main -->

<?php
// get_sidebar();
footer_fuc();
