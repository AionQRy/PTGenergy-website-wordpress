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
.entry-content .v-container {
    padding: 0;
}

.um.um-password {
    padding: 15px;
}
</style>
<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">

	<div class="um-form um-change">
		<?php the_custom_logo(); ?>
<h1>ตั้งรหัสผ่านใหม่</h1>
		<form method="post" action="">
			<input type="hidden" name="_um_password_change" id="_um_password_change" value="1" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $args['user_id'] ); ?>" />
			<input type="hidden" name="rp_key" value="<?php echo esc_attr( $rp_key ); ?>" />

			<?php
			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_change_password_page_hidden_fields
			 * @description Password change hidden fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Password change shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_change_password_page_hidden_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_change_password_page_hidden_fields', 'my_change_password_page_hidden_fields', 10, 1 );
			 * function my_change_password_page_hidden_fields( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_change_password_page_hidden_fields', $args );

			$fields = UM()->builtin()->get_specific_fields( 'user_password' );

			UM()->fields()->set_mode = 'password';

			$output = null;
			foreach ( $fields as $key => $data ) {
				$output .= UM()->fields()->edit_field( $key, $data );
			}
			echo $output; ?>

			<div class="um-col-alt">

				<div class="um-center yp-btn-change">
					<button type="submit" class="um-button" id="um-submit-btn">
						<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
						<?php esc_attr_e( 'Change my password', 'ultimate-member' ); ?>
					</button>
				</div>

				<div class="um-clear"></div>

			</div>

			<?php

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_change_password_form
			 * @description Password change form content
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Password change shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_change_password_form', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_change_password_form', 'my_change_password_form', 10, 1 );
			 * function my_change_password_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_change_password_form', $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_form_fields
			 * @description Password change after form content
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Password change shortcode arguments"}]
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
			do_action( 'um_after_form_fields', $args ); ?>
		</form>
	</div>
</div>
