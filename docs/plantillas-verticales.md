# Plantillas de bloque para verticales

## Alcance de v1

`vicunav-theme-core` no registra ni incluye plantillas específicas de restaurante,
hotel, pagos u otro vertical en v1. Cada plugin vertical es responsable de declarar su
plantilla predeterminada. El theme podrá aportar una presentación alternativa más
adelante sin asumir la lógica de negocio del plugin.

## Registro desde un plugin vertical

Desde WordPress 6.7, un plugin puede registrar una plantilla con
`register_block_template()`. El nombre tiene dos partes separadas por `//`:

```text
namespace-del-plugin//slug-de-la-plantilla
```

Por ejemplo, la plantilla individual del CPT `vicu_menu_item` puede registrarse como
`vicunav-restaurante//single-vicu_menu_item`. El namespace identifica al propietario
del registro; el slug `single-vicu_menu_item` participa en la jerarquía de plantillas
de WordPress.

El registro debe ejecutarse en `init` y proporcionar, como mínimo, contenido de
bloques válido. También conviene declarar un título, una descripción y los tipos de
contenido compatibles:

```php
<?php
/**
 * Registra la plantilla individual predeterminada de un elemento del menú.
 *
 * @return void
 */
function vicunav_restaurante_register_block_templates() {
	if ( ! function_exists( 'register_block_template' ) ) {
		return;
	}

	$result = register_block_template(
		'vicunav-restaurante//single-vicu_menu_item',
		array(
			'title'       => 'Elemento de menú individual',
			'description' => 'Presentación predeterminada de un elemento del menú.',
			'content'     => '<!-- wp:post-title {"level":1} /--><!-- wp:post-content /-->',
			'post_types'  => array( 'vicu_menu_item' ),
		)
	);

	if ( is_wp_error( $result ) ) {
		// El plugin debe gestionar el error según el estándar de observabilidad.
	}
}
add_action( 'init', 'vicunav_restaurante_register_block_templates' );
```

El contenido pertenece al plugin vertical y debe usar bloques disponibles sin depender
de que `vicunav-theme-core` esté activo. De esta manera, el vertical conserva una
salida funcional con cualquier theme de bloques compatible.

## Compatibilidad con WordPress 6.6

La versión mínima del ecosistema es WordPress 6.6, pero
`register_block_template()` se incorporó en WordPress 6.7. Por eso el plugin debe
comprobar `function_exists()` antes de llamar a la función. En WordPress 6.6, la
petición continúa mediante la jerarquía normal del theme; no se registra la plantilla
predeterminada del plugin.

Esta guarda es obligatoria mientras WordPress 6.6 siga dentro de la matriz de
compatibilidad. No debe sustituirse por una implementación privada de la API.

## Sobrescritura futura desde el theme

WordPress relaciona la plantilla registrada y el archivo del theme por el slug, no por
el namespace completo. Para reemplazar visualmente el ejemplo anterior, una versión
futura de este theme podría añadir:

```text
templates/single-vicu_menu_item.html
```

No tendría que volver a registrar
`vicunav-restaurante//single-vicu_menu_item`. Cuando ambos existen, el archivo del
theme con slug `single-vicu_menu_item` aporta el contenido y conserva los metadatos
útiles del registro del plugin.

La precedencia efectiva es:

1. Personalización guardada por el usuario en el Editor del sitio.
2. Archivo `templates/{slug}.html` del theme activo.
3. Plantilla predeterminada registrada por el plugin.

Una personalización guardada en la base de datos sigue teniendo prioridad aunque el
plugin o el theme cambien después. Para volver a la versión del theme o del plugin, el
usuario debe restablecer esa plantilla desde el Editor del sitio.

## Convenciones para los verticales

- Usa el slug real del plugin como namespace, en minúsculas.
- Usa un slug de plantilla que coincida con la jerarquía esperada, por ejemplo
  `single-vicu_menu_item` o `archive-vicu_hotel`.
- Registra cada plantilla una sola vez y comprueba si el resultado es `WP_Error`.
- Limita `post_types` a los CPT que realmente consumen la plantilla.
- Mantén la plantilla libre de lógica de negocio y usa bloques o APIs públicas.
- No asumas que `vicunav-theme-core` está activo.
