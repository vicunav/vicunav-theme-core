<?php
/**
 * Title: Testimonios en cuadrícula
 * Slug: vicunav-theme-core/testimonials-grid
 * Categories: vicunav-theme-core
 * Description: Cuadrícula de testimonios obtenidos del tipo de contenido vicu_testimonial.
 * Inserter: yes
 *
 * @package Vicunav_Theme_Core
 */

?>

<!-- wp:group {"tagName":"section","metadata":{"name":"Testimonios en cuadrícula"},"backgroundColor":"vicunav-neutral-200","textColor":"vicunav-neutral-900","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-xl","right":"var:preset|spacing|vicunav-space-md","bottom":"var:preset|spacing|vicunav-space-xl","left":"var:preset|spacing|vicunav-space-md"},"blockGap":"var:preset|spacing|vicunav-space-lg"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group has-vicunav-neutral-900-color has-vicunav-neutral-200-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-xl);padding-right:var(--wp--preset--spacing--vicunav-space-md);padding-bottom:var(--wp--preset--spacing--vicunav-space-xl);padding-left:var(--wp--preset--spacing--vicunav-space-md)"><!-- wp:heading {"textAlign":"center","textColor":"vicunav-neutral-900","fontSize":"vicunav-xl","fontFamily":"vicunav-heading"} -->
<h2 class="wp-block-heading has-text-align-center has-vicunav-neutral-900-color has-text-color has-vicunav-heading-font-family has-vicunav-xl-font-size">Lo que dicen nuestros clientes</h2>
<!-- /wp:heading -->

<!-- wp:query {"query":{"perPage":6,"pages":0,"offset":0,"postType":"vicu_testimonial","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|vicunav-space-md"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"backgroundColor":"vicunav-neutral-100","textColor":"vicunav-neutral-900","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-lg","right":"var:preset|spacing|vicunav-space-lg","bottom":"var:preset|spacing|vicunav-space-lg","left":"var:preset|spacing|vicunav-space-lg"},"blockGap":"var:preset|spacing|vicunav-space-sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-vicunav-neutral-900-color has-vicunav-neutral-100-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-lg);padding-right:var(--wp--preset--spacing--vicunav-space-lg);padding-bottom:var(--wp--preset--spacing--vicunav-space-lg);padding-left:var(--wp--preset--spacing--vicunav-space-lg)"><!-- wp:post-content {"textColor":"vicunav-neutral-800","fontSize":"vicunav-md","fontFamily":"vicunav-body","layout":{"type":"constrained"}} /-->

<!-- wp:post-title {"level":3,"isLink":false,"textColor":"vicunav-primary","fontSize":"vicunav-lg","fontFamily":"vicunav-heading"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:group {"backgroundColor":"vicunav-neutral-100","textColor":"vicunav-neutral-700","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-lg","right":"var:preset|spacing|vicunav-space-lg","bottom":"var:preset|spacing|vicunav-space-lg","left":"var:preset|spacing|vicunav-space-lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-vicunav-neutral-700-color has-vicunav-neutral-100-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-lg);padding-right:var(--wp--preset--spacing--vicunav-space-lg);padding-bottom:var(--wp--preset--spacing--vicunav-space-lg);padding-left:var(--wp--preset--spacing--vicunav-space-lg)"><!-- wp:paragraph {"align":"center","fontSize":"vicunav-md","fontFamily":"vicunav-body"} -->
<p class="has-text-align-center has-vicunav-body-font-family has-vicunav-md-font-size">Aún no hay testimonios publicados. Este espacio se actualizará automáticamente al añadir el primero.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
