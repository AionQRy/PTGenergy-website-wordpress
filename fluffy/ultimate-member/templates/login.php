<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<style media="screen">
header.two_page_title,header,footer{
	display: none;
}
#primary {
	min-height: auto;
}
.page.wrap-bg {
    min-height: 100vh;
		position: relative;
}
.entry-content {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    position: absolute;
    width: 100%;
}
label,input[type="submit"]{
	    font-family: Segoe UI,'Kanit', sans-serif!important;
}
.entry-content .v-container {
    padding: 0;
}
.um-form a.custom-logo-link img {
    max-width: 100px!important;
}
</style>
<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">

	<div class="um-form">

		<?php the_custom_logo(); ?>
		<h1>PT Enterprise Portal</h1>

		<form method="post" action="" autocomplete="off">

					<div class="um-row _um_row_1 " style="margin: 0 0 20px 0;"><div class="um-col-1">
						<div id="vc_field_username" class="um-field um-field-text  um-field-username um-field-text um-field-type_text" data-key="username">
							<div class="um-field-label">
								<label for="employee_id">
									Employee ID
									<span class="um-req" title="Required">*</span>
								</label>
								<div class="um-clear"></div>
							</div>
							<div class="um-field-area">
								<input autocomplete="off" required="required" class="um-form-field valid " type="text" name="employee_id" id="employee_id" value="" placeholder="" >
							</div>
						</div>
						<div id="um_field_user_password" class="um-field um-field-password  um-field-user_password um-field-password um-field-type_password">
							<div class="um-field-label">
								<label for="vc_user_password">
									Password
									<span class="um-req" title="Required">*</span>
								</label>
								<div class="um-clear"></div>
							</div>
							<div class="um-field-area">
								<input class="um-form-field" type="password" required="required"  name="vc_user_password" id="vc_user_password">
								</div>
							</div>
						</div>
					</div>
			<div class="um-col-alt">
					<!-- <div class="um-field um-field-c">
						<div class="um-field-area">
							<label class="um-field-checkbox">
								<input type="checkbox" name="rememberme" value="1">
								<span class="um-field-checkbox-state"><i class="um-icon-android-checkbox-outline-blank"></i></span>
								<span class="um-field-checkbox-option"> Keep me signed in</span>
							</label>
						</div>
					</div> -->

								<div class="um-clear"></div>

					<div class="um-left um-half">
						<input type="hidden" name="vc_signin" value="1">

						<a href="https://ptpassword.pt.co.th/forgetPassword" class="u-forgot">ลืมรหัสผ่าน</a>
						<input type="submit" value="Login" class="vc-button" id="um-submit-btn">
						<div class="remark-login">
							<strong>คำแนะนำ</strong>
							<p>เข้าระบบด้วย Username, Password เดียวกันกับระบบ HRIS</p>
						</div>
						<?php
						if ($_GET['code'] == '0'): ?>
							<div class="mec-error yp-msg-login">
									ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง
							</div>
						<?php endif; ?>

						<?php
						if ($_GET['code'] == '01'): ?>
							<div class="mec-error yp-msg-login">
									เข้าสู่ระบบไม่สำเร็จ
							</div>
						<?php endif; ?>

					</div>
					<!-- <div class="um-right um-half">
						<a href="https://ypdev.link/register/" class="um-button um-alt">
							Register				</a>
					</div> -->


				<div class="um-clear"></div>

			</div>


			<!-- <div class="um-col-alt-b">
				<a href="https://ypdev.link/password-reset/" class="um-link-alt">
					Forgot your password?		</a>
			</div> -->


				</form>

	</div>

</div>
