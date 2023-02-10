<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
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
.entry-content .v-container {
    padding: 0;
}
.um.um-password {
    padding: 15px;
}

</style>
<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">
	<div class="um-form form-reset">
<?php the_custom_logo(); ?>
		<h1>ตั้งรหัสผ่านใหม่</h1>
		<form method="post" action="">
			<?php if ( isset( $_GET['updated'] ) && 'checkemail' === sanitize_key( $_GET['updated'] ) ) { ?>
				<div class="um-field um-field-block um-field-type_block label-reset">
					<div class="um-field-block">
						<div style="text-align:left;">
							<?php esc_html_e( 'We have sent you a password reset link to your e-mail. Please check your inbox.', 'ultimate-member' ); ?>
						</div>
					</div>
				</div>
			<?php } else { ?>

				<input type="hidden" name="_um_password_reset" id="_um_password_reset" value="1" />

				<?php
				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_reset_password_page_hidden_fields
				 * @description Password reset hidden fields
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Password reset shortcode arguments"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_reset_password_page_hidden_fields', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_reset_password_page_hidden_fields', 'my_reset_password_page_hidden_fields', 10, 1 );
				 * function my_reset_password_page_hidden_fields( $args ) {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_reset_password_page_hidden_fields', $args );

				if ( ! empty( $_GET['updated'] ) ) { ?>
					<div class="um-field um-field-block um-field-type_block">
						<div class="um-field-block">
							<div style="text-align:left;">
								<?php if ( 'expiredkey' === sanitize_key( $_GET['updated'] ) ) {
									_e( 'Your password reset link has expired. Please request a new link below.', 'ultimate-member' );
								} elseif ( 'invalidkey' === sanitize_key( $_GET['updated'] ) ) {
									_e( 'Your password reset link appears to be invalid. Please request a new link below.', 'ultimate-member' );
								} ?>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="um-field um-field-block um-field-type_block">
						<div class="um-field-block label-reset">
							<div style="text-align:left;">
								<?php _e( 'To reset your password, please enter your email address or username below', 'ultimate-member' ); ?>
								<span class="um-req" title="Required">*</span>
							</div>
						</div>
					</div>
				<?php }

				$fields = UM()->builtin()->get_specific_fields( 'username_b' );

				$output = null;
				foreach ( $fields as $key => $data ) {
					$output .= UM()->fields()->edit_field( $key, $data );
				}
				echo $output;

				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_after_password_reset_fields
				 * @description Hook that runs after user reset their password
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Form data"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_after_password_reset_fields', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_after_password_reset_fields', 'my_after_password_reset_fields', 10, 1 );
				 * function my_after_password_reset_fields( $args ) {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_after_password_reset_fields', $args ); ?>

				<div class="um-col-alt yp-btn-reset">

					<div class="um-center">
						<button type="submit" class="um-button" id="um-submit-btn">
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
							<?php esc_attr_e( 'Reset my password', 'ultimate-member' ); ?>
						</button>
					</div>

					<div class="um-clear"></div>

				</div>

				<?php
				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_reset_password_form
				 * @description Password reset display form
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Password reset shortcode arguments"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_reset_password_form', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_reset_password_form', 'my_reset_password_form', 10, 1 );
				 * function my_reset_password_form( $args ) {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_reset_password_form', $args );

				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_after_form_fields
				 * @description Password reset after display form
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Password reset shortcode arguments"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_after_form_fields', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_after_form_fields', 'my_after_form_fields', 10, 1 );
				 * function my_after_form_fields( $args ) {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_after_form_fields', $args );
			} ?>
		</form>
	</div>
</div>
