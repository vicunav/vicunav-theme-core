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
| `vicunav-positive` |
| `vicunav-warning` |
| `vicunav-danger` |
| `vicunav-info` |
| `vicunav-neutral-100` a `vicunav-neutral-900` |

Los slugs son parte del contrato. Los valores hexadecimales actuales son placeholders
y pueden cambiar cuando se apruebe la identidad visual definitiva.

### Espaciado

| Slug | Valor actual |
| --- | --- |
| `vicunav-space-xxs` | `0.25rem` |
| `vicunav-space-xs` | `0.5rem` |
| `vicunav-space-sm` | `1rem` |
| `vicunav-space-md` | `1.5rem` |
| `vicunav-space-lg` | `2rem` |
| `vicunav-space-xl` | `3rem` |
| `vicunav-space-xxl` | `4rem` |
| `vicunav-space-section-sm` | `6rem` |
| `vicunav-space-section-md` | `8rem` |
| `vicunav-space-section-lg` | `12rem` |

Ningún slug de esta escala usa un dígito pegado a una letra (ej. `2xs`). WordPress
inserta un guion en esa frontera al compilar el nombre de la custom property CSS del
preset, así que un slug así nunca coincide con el nombre real generado. Ver
[`child-themes.md`](child-themes.md).

### Tipografía

- Familias: `vicunav-heading` y `vicunav-body`.
- Tamaños: `vicunav-xxs`, `vicunav-sm`, `vicunav-md`, `vicunav-lg`, `vicunav-xl`,
  `vicunav-xxl`, `vicunav-display-sm` y `vicunav-display-lg`.

### Sombras

`vicunav-shadow-card`, `vicunav-shadow-card-hover`, `vicunav-shadow-panel`,
`vicunav-shadow-modal` y `vicunav-shadow-toast`.

### Layout

`settings.layout.contentSize` y `settings.layout.wideSize` están publicados con
valores placeholder. Cualquier vertical o child theme puede sustituirlos.

### Propiedades personalizadas

`settings.custom.vicunav` publica los grupos `border`, `breakpoint`, `container`,
`motion`, `opacity`, `radius`, `surface`, `text` y `section`. Son slots agnósticos con
valores placeholder — su propósito es que cualquier vertical tenga breakpoints,
duraciones de movimiento, radios, opacidades y padding fluido de sección consistentes
sin reinventarlos, no imponer una identidad visual.

## Marca, verticales y child themes

Este theme **no publica ni admite ninguna variación de marca o demo concreto**
(`styles/*.json` con nombre de cliente, paleta real de un negocio, tipografías de
marca, etc.). Los slugs de esta página son el contrato; los valores reales de una
marca de cualquier vertical (restaurante, hotel, estudio de bienestar...) se aplican
en un **child theme** propiedad del demo o del sitio correspondiente, nunca en este
repositorio. El criterio
completo — qué es reutilizable aquí frente a qué va en un child theme, y cómo crear
uno — está documentado en [`child-themes.md`](child-themes.md).

Los cuatro colores semánticos (`vicunav-positive`, `vicunav-warning`, `vicunav-danger`,
`vicunav-info`) son contratos visuales genéricos. El theme no decide qué estado de
negocio corresponde a cada color. Plugins y verticales conservan semántica, texto y
autorización; pueden consumir estos presets con fallbacks neutrales.

El contrato declarativo se valida mediante `bash tests/run.sh`. La suite comprueba
schema, slugs, conteo de pasos por escala y que ni `theme.json` ni este documento
mencionen una marca o demo concreto.

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
anclas iniciales, no rutas contractuales del vertical. No leen estado de carrito,
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
| `vicunav-theme-core/page-hero-banner` | Ninguna |
| `vicunav-theme-core/cta-simple` | Ninguna |
| `vicunav-theme-core/editorial-story` | Ninguna |
| `vicunav-theme-core/editorial-location` | Ninguna |
| `vicunav-theme-core/linked-cards-grid` | Ninguna |
| `vicunav-theme-core/testimonials-grid` | CPT `vicu_testimonial` |
| `vicunav-theme-core/faq-accordion` | CPT `vicu_faq` |
| `vicunav-theme-core/contact-info` | `Vicu\Core\Settings` |

Los patrones que dependen de contenido muestran un estado vacío o valores editables
cuando el plugin correspondiente no está activo.

El hero fotográfico, el banner interior, la historia y la ubicación entregan espacios
de media editables sin URL predeterminada. `editorial-location` es informativo y no
implementa mapas, tarifas ni disponibilidad. `linked-cards-grid` aporta cuatro
destinos iniciales mediante anclas editables, no categorías ni rutas del vertical.

`assets/css/restaurant-patterns.css` solo actúa bajo clases `vicunav-pattern-*`,
`vicunav-linked-*`, `vicunav-editorial-*`, `vicunav-testimonials-*`,
`vicunav-faq-*` y `vicunav-contact-*`. Define composición, foco, targets de 44 px,
responsive y movimiento reducido; los valores visuales efectivos proceden de presets
públicos y conservan fallbacks neutrales.

La matriz que compara las superficies editoriales del restaurante con los patterns
existentes se documenta en
[`patterns-editoriales-restaurante.md`](patterns-editoriales-restaurante.md). El mapa
dinámico de delivery y cualquier catálogo permanecen fuera del theme.

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
