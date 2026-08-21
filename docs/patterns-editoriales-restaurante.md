# Matriz de patterns editoriales para restaurante

## Decisión de reutilización

La auditoría de Bonasera se compara contra el contrato público antes de añadir
composiciones al núcleo. El resultado es deliberadamente pequeño:

| Superficie del prototipo | Pattern del núcleo                   | Decisión                                           |
| ------------------------ | ------------------------------------ | -------------------------------------------------- |
| Hero                     | `hero-centered` o `hero-split-image` | Reutilizar según la media disponible               |
| Historia                 | `editorial-story`                    | Añadir porque faltaba una narración con media y H2 |
| Categorías               | `linked-cards-grid`                  | Añadir como colección genérica de destinos         |
| Ubicación                | `contact-info`                       | Reutilizar para dirección, horario y teléfono      |
| FAQ                      | `faq-accordion`                      | Reutilizar el contenido administrado por core      |
| Testimonios              | `testimonials-grid`                  | Reutilizar el contenido administrado por core      |
| CTA                      | `cta-simple`                         | Reutilizar y editar su copy y destino              |

El mapa interactivo de zonas no es editorial: consulta tarifas y disponibilidad del
vertical. Por eso pertenece a un bloque de `vicunav-restaurante`, no a un pattern del
theme. El video, las fotografías y el copy Bonasera se incorporan únicamente en el
repositorio del demo cuando exista procedencia y licencia verificable.

## Nuevos patterns

`editorial-story` compone Group, Columns, Heading, Paragraph, Buttons y Cover. Usa H2
para poder insertarse debajo del H1 de la página y deja la media como placeholder
editable.

`linked-cards-grid` compone Group, Columns, Cover, Heading, Paragraph y Buttons. Sus
tres destinos son contenido inicial, no categorías de dominio ni rutas contractuales.
Las Columns de core resuelven el apilado responsive sin JavaScript del theme.

Ambos patterns son agnósticos del vertical, usan presets públicos `vicunav-*` y no
incluyen HTML opaco, lógica de negocio, datos personales ni recursos remotos.
