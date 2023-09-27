<?php
/**
 * Registration logic for the new ACF field type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'cr_include_acf_field_math_captcha' );
/**
 * Registers the ACF field type.
 */
function cr_include_acf_field_math_captcha() {
	if ( ! function_exists( 'acf_register_field_type' ) ) {
		return;
	}

	require_once __DIR__ . '/class-cr-acf-field-math-captcha.php';

	acf_register_field_type( 'cr_acf_field_math_captcha' );
}
