# vicunav-theme-core

Propósito: Theme de bloques de WordPress y presentación compartida del ecosistema Vicunav.

## Reglas aplicables

Las reglas transversales del repositorio están en [`docs/standards/`](docs/standards/). Consúltalas antes de realizar cambios.

No repitas esas reglas aquí; este archivo solo contiene el contexto específico del repositorio.

## Compatibilidad con PHP

La versión mínima de PHP del ecosistema Vicunav es 8.1, en coherencia con PHP 8.4
usado por el CI. `vicunav-theme-core`, `vicunav-plugin-core`, `vicunav-pagos`,
`vicunav-hotel` y `vicunav-restaurante` deben declarar y mantener ese mismo mínimo,
sin partir del valor desactualizado incluido por defecto en la plantilla.

## Validación

Este repositorio todavía no tiene pruebas automatizadas. Antes de entregar un cambio,
revisa manualmente la estructura del theme y valida la sintaxis de los archivos JSON.
