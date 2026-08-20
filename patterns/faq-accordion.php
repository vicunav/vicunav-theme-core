<?php
/**
 * Title: Preguntas frecuentes en acordeón
 * Slug: vicunav-theme-core/faq-accordion
 * Categories: vicunav-theme-core
 * Description: Acordeón progresivo obtenido del tipo de contenido vicu_faq.
 * Inserter: yes
 *
 * @package Vicunav_Theme_Core
 */

?>

<!-- wp:group {"tagName":"section","metadata":{"name":"Preguntas frecuentes en acordeón"},"backgroundColor":"vicunav-neutral-100","textColor":"vicunav-neutral-900","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-xl","right":"var:preset|spacing|vicunav-space-md","bottom":"var:preset|spacing|vicunav-space-xl","left":"var:preset|spacing|vicunav-space-md"},"blockGap":"var:preset|spacing|vicunav-space-lg"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group has-vicunav-neutral-900-color has-vicunav-neutral-100-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-xl);padding-right:var(--wp--preset--spacing--vicunav-space-md);padding-bottom:var(--wp--preset--spacing--vicunav-space-xl);padding-left:var(--wp--preset--spacing--vicunav-space-md)"><!-- wp:heading {"textAlign":"center","textColor":"vicunav-neutral-900","fontSize":"vicunav-xl","fontFamily":"vicunav-heading"} -->
<h2 class="wp-block-heading has-text-align-center has-vicunav-neutral-900-color has-text-color has-vicunav-heading-font-family has-vicunav-xl-font-size">Preguntas frecuentes</h2>
<!-- /wp:heading -->

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"vicu_faq","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|vicunav-space-md"}},"layout":{"type":"default"}} -->
<!-- wp:group {"className":"vicunav-faq-accordion__item","backgroundColor":"vicunav-neutral-200","textColor":"vicunav-neutral-900","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-lg","right":"var:preset|spacing|vicunav-space-lg","bottom":"var:preset|spacing|vicunav-space-lg","left":"var:preset|spacing|vicunav-space-lg"},"blockGap":"var:preset|spacing|vicunav-space-sm"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group vicunav-faq-accordion__item has-vicunav-neutral-900-color has-vicunav-neutral-200-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-lg);padding-right:var(--wp--preset--spacing--vicunav-space-lg);padding-bottom:var(--wp--preset--spacing--vicunav-space-lg);padding-left:var(--wp--preset--spacing--vicunav-space-lg)"><!-- wp:post-title {"level":3,"isLink":false,"textColor":"vicunav-neutral-900","fontSize":"vicunav-lg","fontFamily":"vicunav-heading"} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"tagName":"button","type":"button","backgroundColor":"vicunav-primary","textColor":"vicunav-neutral-100","className":"vicunav-faq-accordion__toggle","fontSize":"vicunav-md","fontFamily":"vicunav-body"} -->
<div class="wp-block-button vicunav-faq-accordion__toggle has-custom-font-size has-vicunav-body-font-family has-vicunav-md-font-size"><button type="button" class="wp-block-button__link has-vicunav-neutral-100-color has-vicunav-primary-background-color has-text-color has-background wp-element-button">Ocultar respuesta</button></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"className":"vicunav-faq-accordion__answer","textColor":"vicunav-neutral-800","layout":{"type":"constrained"}} -->
<div class="wp-block-group vicunav-faq-accordion__answer has-vicunav-neutral-800-color has-text-color"><!-- wp:post-content {"fontSize":"vicunav-md","fontFamily":"vicunav-body","layout":{"type":"constrained"}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:group {"backgroundColor":"vicunav-neutral-200","textColor":"vicunav-neutral-700","style":{"spacing":{"padding":{"top":"var:preset|spacing|vicunav-space-lg","right":"var:preset|spacing|vicunav-space-lg","bottom":"var:preset|spacing|vicunav-space-lg","left":"var:preset|spacing|vicunav-space-lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-vicunav-neutral-700-color has-vicunav-neutral-200-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--vicunav-space-lg);padding-right:var(--wp--preset--spacing--vicunav-space-lg);padding-bottom:var(--wp--preset--spacing--vicunav-space-lg);padding-left:var(--wp--preset--spacing--vicunav-space-lg)"><!-- wp:paragraph {"align":"center","fontSize":"vicunav-md","fontFamily":"vicunav-body"} -->
<p class="has-text-align-center has-vicunav-body-font-family has-vicunav-md-font-size">Aún no hay preguntas frecuentes publicadas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
