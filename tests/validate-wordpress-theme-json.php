<?php
/**
 * Valida que WordPress compile el contrato base agnóstico de theme.json.
 *
 * No valida ninguna marca o demo: eso es responsabilidad del test equivalente en el
 * child theme correspondiente (ver docs/child-themes.md).
 *
 * Ejecutar con:
 * wp eval-file tests/validate-wordpress-theme-json.php
 *
 * @package Vicunav_Theme_Core
 */

if ( ! class_exists( 'WP_Theme_JSON' ) || ! class_exists( 'WP_Theme_JSON_Resolver' ) ) {
	throw new RuntimeException( 'WordPress no expone las APIs de theme.json requeridas.' );
}

$theme_data = WP_Theme_JSON_Resolver::get_theme_data();
$stylesheet = $theme_data->get_stylesheet();

$expected_fragments = array(
	'--wp--preset--color--vicunav-primary: #1D4ED8',
	'--wp--preset--spacing--vicunav-space-section-lg: 12rem',
	'--wp--preset--font-size--vicunav-display-lg',
	'--wp--preset--shadow--vicunav-shadow-toast',
	'--wp--custom--vicunav--container--max: 1200px',
	'--wp--custom--vicunav--breakpoint--wide: 1440px',
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

$forbidden_terms = array( 'bonasera', 'guasabara', 'guasábara' );
$lowercased      = strtolower( $stylesheet );
foreach ( $forbidden_terms as $term ) {
	if ( false !== strpos( $lowercased, $term ) ) {
		throw new RuntimeException(
			sprintf(
				/* translators: %s: término de marca prohibido. */
				'El CSS compilado del contrato base menciona una marca concreta: %s',
				esc_html( $term )
			)
		);
	}
}

WP_CLI::success( 'WordPress compiló el contrato base agnóstico de theme.json.' );
