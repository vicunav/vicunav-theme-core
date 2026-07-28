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
