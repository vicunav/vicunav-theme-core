# Child themes por marca o vertical

## Por qué existen

`vicunav-theme-core` es agnóstico: no conoce reservas, pedidos, pagos, ni la
identidad visual de ningún negocio concreto. Publica slugs y valores placeholder
(`docs/contrato-publico.md`) que cualquier vertical (restaurante, hotel, yoga...)
puede reutilizar. Ningún dato de una marca o demo específico — paleta real, familias
tipográficas de marca, archivos de fuente, motivos decorativos bespoke, título de una
variación — se commitea en este repositorio, ni siquiera como una variación de estilo
seleccionable (`styles/*.json`). Un archivo `styles/cliente-x.json` con el nombre de
un cliente aparecería en el selector de Estilos del Site Editor de **cualquier** sitio
que use este theme, no solo el de ese cliente: eso es exactamente lo que un child
theme evita.

Un child theme es el mecanismo nativo de WordPress para aplicar la identidad real de
una marca sin tocar el theme compartido. Vive en el repositorio del demo o del sitio
correspondiente (por ejemplo, `vicunav-demo-restaurante`), nunca aquí.

## Qué va en `vicunav-theme-core` frente a qué va en un child theme

| Elemento | `vicunav-theme-core` (agnóstico) | Child theme (marca/demo) |
| --- | --- | --- |
| Slugs de color, espaciado, tipografía, sombra | Sí — son el contrato | No — no redefine slugs, solo valores |
| Valores reales de esos slugs (paleta real, escala real) | No — solo placeholders | Sí |
| Archivos de fuente reales y su licencia | No | Sí, en `assets/fonts/` del child theme |
| `settings.custom.vicunav.*` (breakpoints, contenedor, movimiento, opacidad, radios, sección) | Sí, con valores placeholder reutilizables por cualquier vertical | Puede sobrescribir valores si la marca lo requiere |
| Templates, template parts y patterns estructurales de un *vertical* (ej. doble header de restaurante, footer completo/mínimo) | Sí, si son reutilizables por cualquier negocio de ese vertical, sin copy ni media propios | No — el child theme los usa, no los duplica |
| CSS o markup de un motivo decorativo específico de una marca (ej. un tratamiento tipográfico particular, una tarjeta con inclinación propia de un diseño) | No | Sí |
| Contenido, copy, media licenciada de un demo concreto | No (eso ni siquiera es un child theme, vive en `post_content` del sitio) | El child theme puede traer patterns con placeholders editables, pero el copy real vive en las páginas, no en el theme |

Regla rápida: si un cambio es solo **valores** para slugs que el contrato base ya
publica (color, tamaño, radio, sombra...), casi siempre alcanza con **Estilos
Globales del Site Editor** — no hace falta ni child theme ni código. Un child theme
solo es necesario cuando además hay que **añadir CSS, templates o patterns propios**
que Estilos Globales no puede expresar (fuentes reales autoalojadas, un motivo
decorativo bespoke, un override de un pattern del núcleo).

## Cómo crear un child theme de `vicunav-theme-core`

1. Directorio propio dentro del repositorio del demo (ej.
   `vicunav-demo-restaurante/theme/<slug-de-marca>/`).
2. `style.css` con cabecera estándar de WordPress, incluyendo:
   ```
   Theme Name: <Nombre de marca>
   Template: vicunav-theme-core
   ```
   `Template` debe coincidir exactamente con el slug del directorio de
   `vicunav-theme-core` en `wp-content/themes/`.
3. `theme.json` propio: WordPress hace *deep merge* automático con el `theme.json` del
   padre. Solo es necesario declarar lo que cambia — los valores reales de los slugs
   ya publicados, y cualquier `custom`/`shadow`/`layout` adicional propio de la marca.
4. `assets/fonts/` con los archivos de fuente reales, checksums y licencias
   documentadas (mismo estándar que exigía antes `assets/fonts/README.md` en
   theme-core).
5. CSS propio para motivos decorativos bespoke, enlazado con
   `wp_enqueue_block_style()` igual que hace `functions.php` de theme-core para sus
   propias hojas scoped — nunca sobrescribiendo el CSS del padre por selector genérico.
6. Patterns/templates propios solo cuando estructuralmente diverjan del patrón
   agnóstico del padre; si solo cambia el copy o la media, se reutiliza el pattern del
   padre y se edita el contenido desde el Editor del sitio.
7. Activar el child theme (no el padre) en el sitio del demo. WordPress usa el
   `stylesheet` del child theme para sus propios Estilos Globales guardados en base de
   datos; no reutiliza los del padre.

## Verificación

Un child theme mantiene su propia suite de pruebas, análoga a la que este repositorio
usa para su contrato base (ver `tests/validate-theme-contract.mjs` y
`tests/validate-wordpress-theme-json.php` de `vicunav-theme-core`), pero validando el
merge real base + child mediante `WP_Theme_JSON` y confirmando que la identidad de
marca aparece en el CSS compilado. `bash tests/run.sh` de este repositorio solo valida
que el contrato base siga siendo agnóstico; nunca validará valores de una marca.
