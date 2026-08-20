# Contrato público de `vicunav-theme-core`

Estado: vigente para la versión 0.1.0.

Este documento define la superficie que otros paquetes Vicunav pueden consumir. Los
detalles internos y los valores visuales provisionales pueden evolucionar; los slugs,
claves y límites aquí declarados requieren coordinación antes de cambiar.

## Responsabilidad

El theme proporciona presentación compartida mediante Full Site Editing. No registra
CPT de negocio, no procesa transacciones y no conoce pedidos, reservas ni pagos.

Un plugin debe seguir funcionando con cualquier theme de bloques compatible. El theme
debe renderizar contenido general aunque los plugins Vicunav no estén activos.

## Compatibilidad

- WordPress 6.6 o superior.
- PHP 8.1 o superior.
- `theme.json` versión 3.

Las plantillas registradas por plugins mediante `register_block_template()` requieren
WordPress 6.7. Los consumidores deben comprobar la existencia de la función mientras
WordPress 6.6 permanezca soportado.

## Tokens de `theme.json`

### Colores

| Slug |
| --- |
| `vicunav-primary` |
| `vicunav-secondary` |
| `vicunav-accent` |
| `vicunav-neutral-100` a `vicunav-neutral-900` |

Los slugs son parte del contrato. Los valores hexadecimales actuales son placeholders
y pueden cambiar cuando se apruebe la identidad visual definitiva.

### Espaciado

| Slug | Valor actual |
| --- | --- |
| `vicunav-space-xs` | `0.5rem` |
| `vicunav-space-sm` | `1rem` |
| `vicunav-space-md` | `1.5rem` |
| `vicunav-space-lg` | `2rem` |
| `vicunav-space-xl` | `3rem` |

### Tipografía

- Familias: `vicunav-heading` y `vicunav-body`.
- Tamaños: `vicunav-sm`, `vicunav-md`, `vicunav-lg` y `vicunav-xl`.

## Variaciones visuales

El theme publica la variación seleccionable `Bonasera` mediante
`styles/bonasera.json`. La variación conserva los slugs contractuales y sustituye solo
sus valores efectivos. No modifica la identidad predeterminada de `theme.json`.

Bonasera añade estos tokens exclusivos de la variación:

- espaciado: `bonasera-space-1`, `bonasera-space-3`, `bonasera-space-8`,
  `bonasera-space-9` y `bonasera-space-10`;
- tamaños: `bonasera-xs`, `bonasera-base`, `bonasera-xl` y `bonasera-xxl`;
- propiedades personalizadas bajo `--wp--custom--bonasera` para radios, sombras y
  espaciado fluido de secciones.

Las familias `vicunav-heading` y `vicunav-body` se resuelven respectivamente a Big
Shoulders Display y Jost cuando la variación está activa. Ambas se sirven desde el
theme bajo SIL Open Font License 1.1, sin dependencia remota de runtime.

La fuente auditada, las mediciones de contraste y la persistencia de la selección se
documentan en [`variacion-bonasera.md`](variacion-bonasera.md).

## Templates y partes

Templates generales:

- `index`
- `front-page`
- `page`
- `single`
- `archive`

Partes disponibles:

- `header-default`
- `header-contact-first`
- `header-restaurant-home`
- `header-restaurant-inner`
- `footer-full`
- `footer-minimal`
- `footer-restaurant-full`
- `footer-restaurant-minimal`

Los cuatro parts de restaurante son variantes visuales y editables. Sus enlaces son
valores iniciales, no rutas contractuales del vertical. No leen estado de carrito,
pedidos, pagos, reservas ni disponibilidad. Sus estilos están scoped y se documentan
en [`chrome-restaurante.md`](chrome-restaurante.md).

Los verticales no deben asumir que el theme incluye un template específico para su
CPT. Cada plugin registra su plantilla predeterminada y el theme puede sobrescribirla
por slug en una versión posterior.

## Patrones

Todos pertenecen a la categoría `vicunav-theme-core`:

| Slug | Dependencia opcional |
| --- | --- |
| `vicunav-theme-core/hero-centered` | Ninguna |
| `vicunav-theme-core/hero-split-image` | Ninguna |
| `vicunav-theme-core/cta-simple` | Ninguna |
| `vicunav-theme-core/testimonials-grid` | CPT `vicu_testimonial` |
| `vicunav-theme-core/faq-accordion` | CPT `vicu_faq` |
| `vicunav-theme-core/contact-info` | `Vicu\Core\Settings` |

Los patrones que dependen de contenido muestran un estado vacío o valores editables
cuando el plugin correspondiente no está activo.

## Integración con `vicunav-plugin-core`

El patrón de contacto comprueba de forma opcional que exista
`Vicu\Core\Settings::get()` y consulta estas claves:

- `phone`
- `address`
- `business_hours`

La ausencia de la clase o de un valor no produce un error fatal. El patrón muestra
texto editable como fallback.

El theme preserva el `post_type` de las consultas para `vicu_faq` y
`vicu_testimonial`, incluso antes de que el plugin registre esos CPT, para evitar que
WordPress sustituya accidentalmente la consulta por entradas normales.

## Plantillas de verticales

El contrato de registro, compatibilidad y precedencia se documenta en
[`plantillas-verticales.md`](plantillas-verticales.md). La prioridad efectiva es:

1. Personalización guardada por el usuario en el Editor del sitio.
2. Archivo `templates/{slug}.html` del theme activo.
3. Plantilla predeterminada registrada por el plugin.

## Gestión de cambios

Cambiar o retirar un slug, una clave de Settings, un CPT consumido o una regla de
precedencia requiere:

1. Identificar consumidores en el hub.
2. Registrar la decisión si altera una frontera arquitectónica.
3. Actualizar este contrato y las pruebas o validaciones del mismo issue.
4. Propagar el cambio a cada consumidor antes de considerarlo verificado.
