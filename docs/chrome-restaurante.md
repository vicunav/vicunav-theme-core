# Chrome reutilizable de restaurante

## Alcance

El sistema visual auditado usa un chrome amplio para la portada y otro compacto para
las vistas internas. El theme los traduce a cuatro template parts editables:

| Slug                        | Uso previsto                                       |
| --------------------------- | -------------------------------------------------- |
| `header-restaurant-home`    | Portada, superficie clara y CTA de ordenar         |
| `header-restaurant-inner`   | Menú, pizzas, carrito, checkout, reservas y cuenta |
| `footer-restaurant-full`    | Portada y páginas editoriales extensas             |
| `footer-restaurant-minimal` | Flujos transaccionales y vistas internas           |

Los parts usan Site Logo, Site Title, Navigation, Buttons, Columns, Heading y
Paragraph. No consultan carrito, pedidos, pagos, reservas ni disponibilidad. El demo
puede editar enlaces y copy en el Editor del sitio.

## Responsive y accesibilidad

`assets/css/restaurant-chrome.css` está limitado a clases
`vicunav-restaurant-header` y `vicunav-restaurant-footer`. El menú overlay de core se
mantiene hasta 1024 px para evitar el desbordamiento observado a 768 px; la navegación
horizontal aparece desde 1024 px. El CTA se oculta por debajo de 768 px y el logo puede
ocultarse por debajo de 480 px si el nombre del sitio necesita el espacio.

Los enlaces y botones táctiles miden al menos 44 px de alto. El foco usa un anillo
doble tinta-crema visible sobre superficies claras y oscuras. El overlay conserva el
control y la gestión de foco del bloque Navigation de WordPress. Las transiciones se
reducen cuando `prefers-reduced-motion: reduce` está activo.

La hoja se registra con `wp_enqueue_block_style()` sobre `core/navigation`, presente
en los cuatro parts. WordPress la entrega en frontend y en el Editor del sitio
mediante su API pública.
