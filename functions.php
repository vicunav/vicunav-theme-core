<?php
/**
 * Funciones del theme Vicunav Core.
 *
 * @package Vicunav_Theme_Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Carga las traducciones del theme desde su propia carpeta `languages`.
 *
 * @return void
 */
function vicunav_theme_core_load_textdomain() {
	load_theme_textdomain( 'vicunav-theme-core', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'vicunav_theme_core_load_textdomain' );

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
 * Encola el estilo base del theme (hoy solo el enlace "Saltar al contenido").
 *
 * Va en `wp_enqueue_scripts`, no en `wp_body_open()`: los estilos encolados
 * después de que `wp_head()` ya imprimió no se agregan a `wp_footer()` como sí
 * ocurre con los scripts, así que quedarían sin imprimirse nunca.
 *
 * @return void
 */
function vicunav_theme_core_enqueue_base_style() {
	wp_enqueue_style(
		'vicunav-theme-core-base',
		get_theme_file_uri( 'assets/css/base.css' ),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'vicunav_theme_core_enqueue_base_style' );

/**
 * Imprime el enlace "Saltar al contenido" al inicio de <body>.
 *
 * Se enlaza a `wp_body_open()` en vez de a cada header porque es el único
 * punto por el que pasan las cinco plantillas del theme, y debe ser el
 * primer elemento enfocable de la página. Va incondicional en toda plantilla
 * porque el ancla `#main-content` existe en las cinco.
 *
 * @return void
 */
function vicunav_theme_core_print_skip_link() {
	printf(
		'<a class="vicunav-skip-link" href="#main-content">%s</a>',
		esc_html__( 'Saltar al contenido', 'vicunav-theme-core' )
	);
}
add_action( 'wp_body_open', 'vicunav_theme_core_print_skip_link' );

/**
 * Carga el comportamiento progresivo del acordeón de preguntas frecuentes.
 *
 * Solo se encola si el contenido de la entrada actual contiene el patrón
 * `faq-accordion` (identificado por su clase estable), en vez de en toda
 * página del sitio.
 *
 * @return void
 */
function vicunav_theme_core_enqueue_scripts() {
	if ( ! vicunav_theme_core_singular_content_contains( 'vicunav-faq-accordion__item' ) ) {
		return;
	}

	wp_enqueue_script(
		'vicunav-theme-core-faq-accordion',
		get_theme_file_uri( 'assets/js/faq-accordion.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'vicunav_theme_core_enqueue_scripts' );

/**
 * Comprueba si el contenido de la entrada actual contiene una marca dada.
 *
 * @param string $needle Fragmento estable a buscar (clase CSS, por ejemplo).
 * @return bool
 */
function vicunav_theme_core_singular_content_contains( string $needle ): bool {
	if ( ! is_singular() ) {
		return false;
	}

	$post = get_post();

	return $post instanceof WP_Post && str_contains( (string) $post->post_content, $needle );
}

/**
 * Registra el estilo scoped del chrome reutilizable de restaurante.
 *
 * @return void
 */
function vicunav_theme_core_register_restaurant_chrome_style() {
	$style_path = get_theme_file_path( 'assets/css/restaurant-chrome.css' );

	wp_enqueue_block_style(
		'core/navigation',
		array(
			'handle' => 'vicunav-theme-core-restaurant-chrome',
			'src'    => get_theme_file_uri( 'assets/css/restaurant-chrome.css' ),
			'path'   => $style_path,
			'ver'    => file_exists( $style_path ) ? (string) filemtime( $style_path ) : wp_get_theme()->get( 'Version' ),
		)
	);
}

/**
 * Registra el chrome de restaurante para el Editor sin restricción de plantilla.
 *
 * El Editor no dispara la acción `wp`, así que esta rama se mantiene
 * incondicional para no perder el estilo en su iframe de vista previa.
 *
 * @return void
 */
function vicunav_theme_core_register_restaurant_chrome_style_in_admin() {
	if ( is_admin() ) {
		vicunav_theme_core_register_restaurant_chrome_style();
	}
}
add_action( 'init', 'vicunav_theme_core_register_restaurant_chrome_style_in_admin' );

/**
 * Registra el chrome de restaurante en frontend solo donde se usa.
 *
 * Las partes de header/footer de restaurante solo las usan `front-page` y
 * `page`; `single`, `archive` e `index` usan el chrome genérico. Como estas
 * partes no viven en `post_content` (son template parts), se acota por
 * plantilla en vez de por contenido de la entrada. Se usa la acción `wp`, que
 * corre después de resolver la consulta principal (a diferencia de `init`) y
 * antes de `wp_enqueue_scripts`, para que `wp_enqueue_block_style()` siga
 * imprimiendo en el `<head>` en vez de diferir a `wp_footer`.
 *
 * @return void
 */
function vicunav_theme_core_register_restaurant_chrome_style_on_frontend() {
	if ( is_front_page() || is_page() ) {
		vicunav_theme_core_register_restaurant_chrome_style();
	}
}
add_action( 'wp', 'vicunav_theme_core_register_restaurant_chrome_style_on_frontend' );

/**
 * Registra el estilo scoped de los patterns editoriales de restaurante.
 *
 * @return void
 */
function vicunav_theme_core_register_restaurant_pattern_style() {
	$style_path = get_theme_file_path( 'assets/css/restaurant-patterns.css' );

	wp_enqueue_block_style(
		'core/group',
		array(
			'handle' => 'vicunav-theme-core-restaurant-patterns',
			'src'    => get_theme_file_uri( 'assets/css/restaurant-patterns.css' ),
			'path'   => $style_path,
			'ver'    => file_exists( $style_path ) ? (string) filemtime( $style_path ) : wp_get_theme()->get( 'Version' ),
		)
	);
}

/**
 * Comprueba si el contenido de la entrada actual usa algún pattern editorial.
 *
 * @return bool
 */
function vicunav_theme_core_singular_uses_restaurant_patterns(): bool {
	$markers = array(
		'vicunav-pattern-',
		'vicunav-linked-',
		'vicunav-editorial-',
		'vicunav-testimonials-',
		'vicunav-faq-',
		'vicunav-contact-',
	);

	foreach ( $markers as $marker ) {
		if ( vicunav_theme_core_singular_content_contains( $marker ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Registra los patterns de restaurante para el Editor sin restricción de contenido.
 *
 * @return void
 */
function vicunav_theme_core_register_restaurant_pattern_style_in_admin() {
	if ( is_admin() ) {
		vicunav_theme_core_register_restaurant_pattern_style();
	}
}
add_action( 'init', 'vicunav_theme_core_register_restaurant_pattern_style_in_admin' );

/**
 * Registra los patterns de restaurante en frontend solo donde se usan.
 *
 * Cualquier pattern de este theme puede insertarse en cualquier tipo de
 * contenido, no solo en páginas, así que se acota por contenido de la
 * entrada en vez de por plantilla. Ver el comentario sobre la acción `wp`
 * en `vicunav_theme_core_register_restaurant_chrome_style_on_frontend()`.
 *
 * @return void
 */
function vicunav_theme_core_register_restaurant_pattern_style_on_frontend() {
	if ( vicunav_theme_core_singular_uses_restaurant_patterns() ) {
		vicunav_theme_core_register_restaurant_pattern_style();
	}
}
add_action( 'wp', 'vicunav_theme_core_register_restaurant_pattern_style_on_frontend' );
