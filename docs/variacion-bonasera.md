# Variación visual Bonasera

## Fuente

- Proyecto auditado: `vicunav-design-to-claude-demo-restaurante`.
- Commit inmutable: `1e1f62787e088c0ca9701500e764802499d1b253`.
- Fuentes de tokens: `docs/DESIGN_SYSTEM.md` y `src/styles/tokens.css` del proyecto
  auditado.
- Alcance: presentación compartida. Menú, pedidos, pagos, reservas y disponibilidad
  permanecen fuera del theme.

## Traducción a FSE

`styles/bonasera.json` conserva los slugs contractuales de color, espaciado,
tipografía y tamaños para que los patterns y template parts existentes no pierdan sus
referencias. La selección cambia sus valores únicamente dentro de la variación.
`theme.json` continúa siendo la identidad predeterminada.

La variación añade tokens propios solo donde la escala Bonasera tiene más pasos que el
contrato base:

- espaciado: `bonasera-space-1`, `bonasera-space-3`, `bonasera-space-8`,
  `bonasera-space-9` y `bonasera-space-10`;
- tipografía: `bonasera-xs`, `bonasera-base`, `bonasera-xl` y `bonasera-xxl`;
- sombras: tarjeta, tarjeta elevada, modal, panel lateral y aviso;
- custom properties bajo `--wp--custom--bonasera` para bordes, breakpoints,
  contenedor, movimiento, opacidades, radios, sombras, superficies, texto y padding
  fluido de secciones.

La escala efectiva cubre los diez pasos 4, 8, 12, 16, 24, 32, 48, 64, 96 y 140 px;
los ocho tamaños 11, 12.5, 14, 15, 19, 22, 26 y 36 a 54 px; el contenedor de 1240 px;
y los breakpoints 480, 768, 1024 y 1440 px. El ritmo de bloque predeterminado usa
24 px. Los headings conservan Big Shoulders Display, peso 800, uppercase y escala
vertical 1.22; el cuerpo y los controles usan Jost.

Los estilos globales cubren fondo, texto, enlaces, botones, headings, navegación,
título del sitio, imágenes y separación de grupos de botones. Geometría de secciones,
patterns y chrome se implementan en THEME-REST-05; los estados funcionales y su markup
permanecen en `vicunav-restaurante`.

El theme publica solo los colores visuales genéricos positivo, advertencia, peligro e
información. La semántica, el texto y la transición de cada estado transaccional
pertenecen a los bloques del plugin que lo representan.

## Contraste

Las relaciones se calcularon con luminancia relativa WCAG 2.1, sin redondear para
aprobar un umbral:

| Combinación | Relación | Uso |
| --- | ---: | --- |
| Tinta `#0D0D0D` sobre crema `#FAEBD7` | 16.59:1 | Texto y controles principales |
| Marrón `#4A3B33` sobre crema `#FAEBD7` | 9.13:1 | Hover y enlaces secundarios |
| Crema `#FAEBD7` sobre tinta `#0D0D0D` | 16.59:1 | Botones y superficies inversas |
| Tinta `#0D0D0D` sobre salvia `#9DAAAA` | 8.11:1 | Acentos con texto |
| Tinta `#0D0D0D` sobre papel `#FFFDF8` | 19.12:1 | Tarjetas editoriales |
| Crema `#FAEBD7` sobre marrón `#4A3B33` | 9.13:1 | Hover de botones |
| Positivo `#4D673B` sobre crema `#FAEBD7` | 5.40:1 | Estado positivo genérico |
| Advertencia `#9F4527` sobre crema `#FAEBD7` | 5.35:1 | Estado de advertencia genérico |
| Peligro `#A8432B` sobre crema `#FAEBD7` | 5.12:1 | Error o estado destructivo genérico |
| Información `#557259` sobre crema `#FAEBD7` | 4.55:1 | Estado informativo genérico |

La fuente usaba `#C1592F`, `#5B7A45` y `#7C9A7E` en combinaciones que no alcanzaban
4.5:1 para texto normal sobre crema. Gutenberg usa variantes oscurecidas para corregir
ese defecto de accesibilidad, según el criterio aprobado para la migración. Los slugs
son genéricos: el theme no conoce reservas, pedidos ni pagos.

El foco de enlaces y botones usa un anillo doble tinta-crema. La banda de tinta es
perceptible sobre fondos claros y la banda crema sobre fondos oscuros, sin depender de
un único color para ambos contextos.

## Fuentes y privacidad

Big Shoulders Display y Jost se sirven desde `assets/fonts/`. No existen solicitudes a
Google Fonts en frontend ni en el Editor del sitio. Procedencia, licencia y checksums
están documentados en [`assets/fonts/README.md`](../assets/fonts/README.md).

## Persistencia de WordPress

WordPress guarda en base de datos la variación elegida y las personalizaciones
posteriores. Cambiar el archivo no sobrescribe una selección ya personalizada. Para
probar una revisión se usa un sitio limpio o se restablecen los estilos globales solo
con autorización explícita.

## Verificación

`bash tests/run.sh` valida de forma determinista el contrato declarativo, los hashes de
fuentes y el contraste. La prueba contra WordPress debe además combinar `theme.json`
con `styles/bonasera.json` mediante `WP_Theme_JSON` y comprobar que el CSS resultante
incluye las dos familias, la paleta, presets, custom properties y reglas globales. La
revisión visual se hace tanto en frontend como en el Editor del sitio. La selección
persistida y su idempotencia pertenecen a DEMO-REST-02B.

La comprobación de integración es de solo lectura y se ejecuta dentro de un WordPress
real con `wp eval-file tests/validate-wordpress-theme-json.php`. No selecciona la
variación, no guarda Global Styles y no modifica contenido.
