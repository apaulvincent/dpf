<?php

/**
 * Runs on plugin activations
 * - Transfer any settings which may have been set in the Lite version of the plugin
 * - Creates a post type 'mc4wp-form' and enters the form mark-up from the Lite version
 */
function mc4wp_pro_install() {

	// check if PRO option exists and contains data entered by user
	$pro_options = get_option( 'mc4wp', false );
	if ( $pro_options === false )  {
		// create new settings array
		$settings = include dirname( __FILE__ ) . '/../config/default-options.php';

		$lite_settings = array(
			'general' => (array) get_option( 'mc4wp_lite' ),
			'checkbox' => (array) get_option( 'mc4wp_lite_checkbox' ),
			'form' => (array) get_option( 'mc4wp_lite_form' )
		);

		foreach ( $settings as $group_key => $options ) {
			foreach ( $options as $option_key => $option_value ) {
				if ( isset( $lite_settings[$group_key][$option_key] ) && ! empty( $lite_settings[$group_key][$option_key] ) ) {
					$settings[$group_key][$option_key] = $lite_settings[$group_key][$option_key];
				}
			}
		}

		// store options
		update_option( 'mc4wp', $settings['general'] );
		update_option( 'mc4wp_checkbox', $settings['checkbox'] );
		update_option( 'mc4wp_form', $settings['form'] );
	}

	// Transfer form from Lite, but only if no Pro forms exist yet.
	$forms = get_posts(
		array(
			'post_type' => 'mc4wp-form',
			'post_status' => 'publish'
		)
	);

	if ( empty( $forms ) ) {
		// no forms found, try to transfer from lite.
		$form_markup = ( isset( $lite_settings['form']['markup'] ) ) ? $lite_settings['form']['markup'] : "<p>\n\t<label for=\"mc4wp_email\">Email address: </label>\n\t<input type=\"email\" id=\"mc4wp_email\" name=\"EMAIL\" required placeholder=\"Your email address\" />\n</p>\n\n<p>\n\t<input type=\"submit\" value=\"Sign up\" />\n</p>";
		$form_id = wp_insert_post( array(
			'post_type' => 'mc4wp-form',
			'post_title' => 'Sign-Up Form #1',
			'post_content' => $form_markup,
			'post_status' => 'publish'
		) );

		// set default form ID (for when no ID given in shortcode / function args)
		update_option( 'mc4wp_default_form_id', $form_id );

		$lists = isset( $lite_settings['form']['lists'] ) ? $lite_settings['form']['lists'] : array();
		update_post_meta( $form_id, '_mc4wp_settings', array( 'lists' => $lists ) );
	}


}