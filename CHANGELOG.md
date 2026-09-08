# Changelog

Todos los cambios notables de este theme se documentan en este archivo.

El formato sigue [Keep a Changelog](https://keepachangelog.com/es-ES/1.1.0/) y el
versionado, [Semantic Versioning](https://semver.org/lang/es/). Los cambios
anteriores a la creación de este archivo están en el historial de git; no se
reconstruyen retroactivamente aquí.

## [Sin publicar]

### Corregido

- `single`, `archive` e `index` ahora incluyen chrome genérico (header/footer);
  antes se servían sin navegación ni pie de página.
- Los estilos y scripts de restaurante (`faq-accordion.js`,
  `restaurant-chrome.css`, `restaurant-patterns.css`) ahora se cargan solo
  donde el contenido o la plantilla los usa, reconociendo tanto patterns
  copiados en el contenido como referenciados por slug (`wp:pattern`).

### Añadido

- `load_theme_textdomain()` para traducciones propias del theme.

## [0.1.0]

Versión inicial. Ver el historial de git para el detalle de esta versión.
