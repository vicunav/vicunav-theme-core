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
- custom properties bajo `--wp--custom--bonasera` para radios, sombras y padding
  fluido de secciones.

Los valores de estado transaccional no se publican como tokens editoriales del theme.
Pertenecen a los bloques del plugin que representan cada estado.

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
