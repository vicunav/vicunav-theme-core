<?php
/**
 * Title: Información de contacto
 * Slug: vicunav-theme-core/contact-info
 * Categories: vicunav-theme-core
 * Description: Teléfono, dirección y horario obtenidos de los ajustes compartidos.
 * Inserter: yes
 *
 * @package Vicunav_Theme_Core
 */

$vicunav_contact_values = array(
	'phone'          => 'Agrega aquí el teléfono del negocio',
	'address'        => 'Agrega aquí la dirección del negocio',
	'business_hours' => 'Agrega aquí el horario de atención',
);

if (
	class_exists( '\Vicu\Core\Settings' ) &&
	is_callable( array( '\Vicu\Core\Settings', 'get' ) )
) {
	foreach ( array_keys( $vicunav_contact_values ) as $vicunav_contact_key ) {
		$vicunav_contact_value = \Vicu\Core\Settings::get( $vicunav_contact_key );

		if ( is_scalar( $vicunav_contact_value ) && '' !== trim( (string) $vicunav_contact_value ) ) {
			$vicunav_contact_values[ $vicunav_contact_key ] = (string) $vicunav_contact_value;
		}
	}
}
?>

<!-- wp:group {"tagName":"section","metadata":{"name":"Información de contacto"},"backgroundColor":"vicunav-neutral-200","textColor":"vicunav-neutral-900","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-xl","right":"var:preset|spacing|vicunav-space-md","bottom":"var:preset|spacing|vicunav-space-xl","left":"var:preset|spacing|vicunav-space-md"},"blockGap":"var:preset|spacing|vicunav-space-lg"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group has-vicunav-neutral-900-color has-vicunav-neutral-200-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-xl);padding-right:var(--wp--preset--spacing--vicunav-space-md);padding-bottom:var(--wp--preset--spacing--vicunav-space-xl);padding-left:var(--wp--preset--spacing--vicunav-space-md)"><!-- wp:heading {"textAlign":"center","textColor":"vicunav-neutral-900","fontSize":"vicunav-xl","fontFamily":"vicunav-heading"} -->
<h2 class="wp-block-heading has-text-align-center has-vicunav-neutral-900-color has-text-color has-vicunav-heading-font-family has-vicunav-xl-font-size">Información de contacto</h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|vicunav-space-md"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"vicunav-neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-lg","right":"var:preset|spacing|vicunav-space-lg","bottom":"var:preset|spacing|vicunav-space-lg","left":"var:preset|spacing|vicunav-space-lg"},"blockGap":"var:preset|spacing|vicunav-space-sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-vicunav-neutral-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-lg);padding-right:var(--wp--preset--spacing--vicunav-space-lg);padding-bottom:var(--wp--preset--spacing--vicunav-space-lg);padding-left:var(--wp--preset--spacing--vicunav-space-lg)"><!-- wp:heading {"level":3,"textColor":"vicunav-primary","fontSize":"vicunav-lg","fontFamily":"vicunav-heading"} -->
<h3 class="wp-block-heading has-vicunav-primary-color has-text-color has-vicunav-heading-font-family has-vicunav-lg-font-size">Teléfono</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"vicunav-neutral-800","fontSize":"vicunav-md","fontFamily":"vicunav-body"} -->
<p class="has-vicunav-neutral-800-color has-text-color has-vicunav-body-font-family has-vicunav-md-font-size"><?php echo esc_html( $vicunav_contact_values['phone'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"vicunav-neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-lg","right":"var:preset|spacing|vicunav-space-lg","bottom":"var:preset|spacing|vicunav-space-lg","left":"var:preset|spacing|vicunav-space-lg"},"blockGap":"var:preset|spacing|vicunav-space-sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-vicunav-neutral-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-lg);padding-right:var(--wp--preset--spacing--vicunav-space-lg);padding-bottom:var(--wp--preset--spacing--vicunav-space-lg);padding-left:var(--wp--preset--spacing--vicunav-space-lg)"><!-- wp:heading {"level":3,"textColor":"vicunav-primary","fontSize":"vicunav-lg","fontFamily":"vicunav-heading"} -->
<h3 class="wp-block-heading has-vicunav-primary-color has-text-color has-vicunav-heading-font-family has-vicunav-lg-font-size">Dirección</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"vicunav-neutral-800","fontSize":"vicunav-md","fontFamily":"vicunav-body"} -->
<p class="has-vicunav-neutral-800-color has-text-color has-vicunav-body-font-family has-vicunav-md-font-size"><?php echo esc_html( $vicunav_contact_values['address'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"vicunav-neutral-100","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-lg","right":"var:preset|spacing|vicunav-space-lg","bottom":"var:preset|spacing|vicunav-space-lg","left":"var:preset|spacing|vicunav-space-lg"},"blockGap":"var:preset|spacing|vicunav-space-sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-vicunav-neutral-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-lg);padding-right:var(--wp--preset--spacing--vicunav-space-lg);padding-bottom:var(--wp--preset--spacing--vicunav-space-lg);padding-left:var(--wp--preset--spacing--vicunav-space-lg)"><!-- wp:heading {"level":3,"textColor":"vicunav-primary","fontSize":"vicunav-lg","fontFamily":"vicunav-heading"} -->
<h3 class="wp-block-heading has-vicunav-primary-color has-text-color has-vicunav-heading-font-family has-vicunav-lg-font-size">Horario</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"vicunav-neutral-800","fontSize":"vicunav-md","fontFamily":"vicunav-body"} -->
<p class="has-vicunav-neutral-800-color has-text-color has-vicunav-body-font-family has-vicunav-md-font-size"><?php echo esc_html( $vicunav_contact_values['business_hours'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
