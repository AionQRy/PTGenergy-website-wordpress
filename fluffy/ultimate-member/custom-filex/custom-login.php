<?php
remove_action( 'um_after_login_fields', 'um_add_submit_button_to_login', 1000 );

remove_action( 'um_after_login_fields', 'um_after_login_submit', 1001 );






/**
 * Show the submit button
 *
 * @param $args
 */
function um_add_submit_button_to_login2( $args ) {
	/**
	 * UM hook
	 *
	 * @type filter
	 * @title um_login_form_button_one
	 * @description Change Login Form Primary button
	 * @input_vars
	 * [{"var":"$primary_btn_word","type":"string","desc":"Button text"},
	 * {"var":"$args","type":"array","desc":"Login Form arguments"}]
	 * @change_log
	 * ["Since: 2.0"]
	 * @usage
	 * <?php add_filter( 'um_login_form_button_one', 'function_name', 10, 2 ); ?>
	 * @example
	 * <?php
	 * add_filter( 'um_login_form_button_one', 'my_login_form_button_one', 10, 2 );
	 * function my_login_form_button_one( $primary_btn_word, $args ) {
	 *     // your code here
	 *     return $primary_btn_word;
	 * }
	 * ?>
	 */
	$primary_btn_word = apply_filters('um_login_form_button_one', $args['primary_btn_word'], $args );

	if ( ! isset( $primary_btn_word ) || $primary_btn_word == '' ){
		$primary_btn_word = UM()->options()->get( 'login_primary_btn_word' );
	}

	/**
	 * UM hook
	 *
	 * @type filter
	 * @title um_login_form_button_two
	 * @description Change Login Form Secondary button
	 * @input_vars
	 * [{"var":"$secondary_btn_word","type":"string","desc":"Button text"},
	 * {"var":"$args","type":"array","desc":"Login Form arguments"}]
	 * @change_log
	 * ["Since: 2.0"]
	 * @usage
	 * <?php add_filter( 'um_login_form_button_two', 'function_name', 10, 2 ); ?>
	 * @example
	 * <?php
	 * add_filter( 'um_login_form_button_two', 'my_login_form_button_two', 10, 2 );
	 * function my_login_form_button_two( $secondary_btn_word, $args ) {
	 *     // your code here
	 *     return $secondary_btn_word;
	 * }
	 * ?>
	 */
	$secondary_btn_word = apply_filters( 'um_login_form_button_two', $args['secondary_btn_word'], $args );

	if ( ! isset( $secondary_btn_word ) || $secondary_btn_word == '' ){
		$secondary_btn_word = UM()->options()->get( 'login_secondary_btn_word' );
	}

	$secondary_btn_url = ! empty( $args['secondary_btn_url'] ) ? $args['secondary_btn_url'] : um_get_core_page( 'register' );
	/**
	 * UM hook
	 *
	 * @type filter
	 * @title um_login_form_button_two_url
	 * @description Change Login Form Secondary button URL
	 * @input_vars
	 * [{"var":"$secondary_btn_url","type":"string","desc":"Button URL"},
	 * {"var":"$args","type":"array","desc":"Login Form arguments"}]
	 * @change_log
	 * ["Since: 2.0"]
	 * @usage
	 * <?php add_filter( 'um_login_form_button_two_url', 'function_name', 10, 2 ); ?>
	 * @example
	 * <?php
	 * add_filter( 'um_login_form_button_two_url', 'my_login_form_button_two_url', 10, 2 );
	 * function my_login_form_button_two_url( $secondary_btn_url, $args ) {
	 *     // your code here
	 *     return $secondary_btn_url;
	 * }
	 * ?>
	 */
	$secondary_btn_url = apply_filters( 'um_login_form_button_two_url', $secondary_btn_url, $args ); ?>

	<div class="um-col-alt yp-custom-login">


		<div class="box-remem">
			<div class="um-left um-half">
			<?php if ( ! empty( $args['show_rememberme'] ) ) {
				UM()->fields()->checkbox( 'rememberme', __( 'Keep me signed in', 'ultimate-member' ), false ); ?>
			<?php }
			?>
			</div>
			<div class="um-right um-half">
				<div class="yp-forgot">
					<a href="<?php echo esc_url( um_get_core_page( 'password-reset' ) ); ?>" class="um-link-alt">
						<?php _e( 'Forgot your password?', 'ultimate-member' ); ?>
					</a>
				</div>
				</div>
				<div class="um-clear"></div>

		</div>

			<div class="um-left um-half">
				<button type="submit" class="um-button custom-login-btn" id="um-submit-btn" />
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
					<?php esc_attr_e( wp_unslash( $primary_btn_word ), 'ultimate-member' ) ?>
				</button>
			</div>
			<div class="um-right um-half">
				<a href="<?php echo esc_url( $secondary_btn_url ); ?>" class="um-button go-register um-alt">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					<?php if (get_locale() == 'th'): ?>
						<?php echo "สมัครสมาชิก"; ?>
						<?php else: ?>
						<?php echo "Register"; ?>
					<?php endif; ?>
				</a>
			</div>



		<div class="um-clear"></div>
		<div class="nsl-separator">
			<?php
				if ( get_locale()  == 'th') {
						echo "หรือ";
				}
				else {
					echo 'OR';
				}
			?>
		</div>

	</div>

	<?php
}
add_action( 'um_after_login_fields', 'um_add_submit_button_to_login2', 1000 );
