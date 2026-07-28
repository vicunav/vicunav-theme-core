<?php
/**
 * Funciones del theme Vicunav Core.
 *
 * @package Vicunav_Theme_Core
 */

/**
 * Registra las categorías de patrones propias del theme.
 *
 * @return void
 */
function vicunav_theme_core_register_pattern_categories() {
	register_block_pattern_category(
		'vicunav-theme-core',
		array(
			'label' => __( 'Vicunav', 'vicunav-theme-core' ),
		)
	);
}
add_action( 'init', 'vicunav_theme_core_register_pattern_categories' );

/**
 * Conserva el tipo de contenido de las consultas verticales del theme.
 *
 * WordPress sustituye por entradas una consulta cuyo tipo todavía no está
 * registrado. El patrón debe mostrar su estado vacío hasta que el plugin
 * responsable registre el tipo de contenido.
 *
 * @param array    $query Argumentos preparados para WP_Query.
 * @param WP_Block $block Bloque Post Template que ejecuta la consulta.
 * @return array
 */
function vicunav_theme_core_preserve_vertical_query_post_type( $query, $block ) {
	$post_type = $block->context['query']['postType'] ?? '';

	if ( in_array( $post_type, array( 'vicu_testimonial', 'vicu_faq' ), true ) ) {
		$query['post_type'] = $post_type;
	}

	return $query;
}
add_filter( 'query_loop_block_query_vars', 'vicunav_theme_core_preserve_vertical_query_post_type', 10, 2 );

/**
 * Carga el comportamiento progresivo del acordeón de preguntas frecuentes.
 *
 * @return void
 */
function vicunav_theme_core_enqueue_scripts() {
	wp_enqueue_script(
		'vicunav-theme-core-faq-accordion',
		get_theme_file_uri( 'assets/js/faq-accordion.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'vicunav_theme_core_enqueue_scripts' );
