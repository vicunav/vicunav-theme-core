# Matriz de patterns editoriales para restaurante

## Decisión de reutilización

La auditoría de Bonasera se compara contra el contrato público antes de añadir
composiciones al núcleo. El resultado es deliberadamente pequeño:

| Superficie del prototipo | Pattern del núcleo                   | Decisión                                           |
| ------------------------ | ------------------------------------ | -------------------------------------------------- |
| Hero                     | `hero-centered` o `hero-split-image` | Reutilizar según la composición y media disponible |
| Banner interior          | `page-hero-banner`                   | Añadir como Cover compacto para vistas internas    |
| Historia                 | `editorial-story`                    | Reutilizar narración con media y H2                 |
| Categorías               | `linked-cards-grid`                  | Reutilizar cuatro destinos editoriales genéricos   |
| Ubicación                | `editorial-location`                 | Añadir media, dirección, horario y nota informativa |
| FAQ                      | `faq-accordion`                      | Reutilizar el contenido administrado por core      |
| Testimonios              | `testimonials-grid`                  | Reutilizar el contenido administrado por core      |
| Contacto                 | `contact-info`                       | Reutilizar ajustes compartidos con fallback        |
| CTA                      | `cta-simple`                         | Reutilizar y editar copy y destino                  |

El mapa interactivo de zonas no es editorial: consulta tarifas y disponibilidad del
vertical. Por eso pertenece a un bloque de `vicunav-restaurante`, no a un pattern del
theme. El video, las fotografías y el copy Bonasera se incorporan únicamente en el
repositorio del demo cuando exista procedencia y licencia verificable.

## Nuevos patterns

`hero-centered` y `page-hero-banner` usan Cover sin URL inicial. El primero reserva la
altura y la jerarquía del hero de portada; el segundo reproduce el banner de 210 px de
las vistas internas. Ambos mantienen un único H1 editable y aceptan media propia del
demo.

`editorial-story` compone Group, Columns, Heading, Paragraph, Buttons y Cover. Usa H2
para poder insertarse debajo del H1 de la página y deja la media como placeholder
editable. `editorial-location` mantiene la misma estrategia, pero conserva dirección,
horario y notas como texto independiente. El mapa interactivo continúa fuera del
theme.

`linked-cards-grid` compone Group, Columns, Cover, Heading, Paragraph y Buttons. Sus
cuatro destinos son contenido inicial, no categorías de dominio ni rutas
contractuales. El CSS scoped conserva una columna en móvil, dos desde 480 px y cuatro
desde 1024 px sin JavaScript del theme.

Todos los patterns son agnósticos del vertical, usan presets públicos `vicunav-*` y no
incluyen HTML opaco, lógica de negocio, datos personales ni recursos remotos. La hoja
`restaurant-patterns.css` corrige overflow, wrapping, foco, targets táctiles y
movimiento reducido en frontend y Editor del sitio.
