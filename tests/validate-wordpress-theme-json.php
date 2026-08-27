<?php
/**
 * Valida que WordPress compile el contrato visual Bonasera.
 *
 * Ejecutar con:
 * wp eval-file tests/validate-wordpress-theme-json.php
 *
 * @package Vicunav_Theme_Core
 */

if ( ! class_exists( 'WP_Theme_JSON' ) || ! class_exists( 'WP_Theme_JSON_Resolver' ) ) {
	throw new RuntimeException( 'WordPress no expone las APIs de theme.json requeridas.' );
}

$variation_path = get_theme_file_path( 'styles/bonasera.json' );
$variation_data = wp_json_file_decode(
	$variation_path,
	array(
		'associative' => true,
	)
);

if ( ! is_array( $variation_data ) ) {
	throw new RuntimeException( 'WordPress no pudo leer la variación Bonasera.' );
}

$theme_data = WP_Theme_JSON_Resolver::get_theme_data();
$theme_data->merge( new WP_Theme_JSON( $variation_data, 'theme' ) );
$stylesheet = $theme_data->get_stylesheet();

$expected_fragments = array(
	'Big Shoulders Display',
	'Jost, sans-serif',
	'--wp--preset--color--vicunav-primary: #0D0D0D',
	'--wp--preset--spacing--bonasera-space-10: 8.75rem',
	'--wp--preset--shadow--bonasera-card',
	'--wp--custom--bonasera--container--max: 1240px',
	'transform: scaleY(1.22)',
	'opacity: 0.72',
);

foreach ( $expected_fragments as $fragment ) {
	if ( false === strpos( $stylesheet, $fragment ) ) {
		throw new RuntimeException(
			sprintf(
				/* translators: %s: fragmento CSS esperado. */
				'El CSS compilado no contiene: %s',
				esc_html( $fragment )
			)
		);
	}
}

WP_CLI::success( 'WordPress compiló el contrato visual Bonasera.' );
