# vicunav-theme-core

Propósito: Theme de bloques de WordPress y presentación compartida del ecosistema Vicunav.

## Reglas aplicables

Las reglas transversales del repositorio están en [`docs/standards/`](docs/standards/). Consúltalas antes de realizar cambios.

No repitas esas reglas aquí; este archivo solo contiene el contexto específico del repositorio.

## Compatibilidad

La compatibilidad mínima del ecosistema está definida en
[`docs/standards/docs/compatibility.md`](docs/standards/docs/compatibility.md).

## Validación

Este repositorio todavía no tiene pruebas automatizadas. Antes de entregar un cambio,
revisa manualmente la estructura y el renderizado del theme. Valida la sintaxis de
`theme.json`, ejecuta `php -l` sobre los archivos PHP modificados y comprueba los
estados visuales e interactivos aplicables en LocalWP.

El contrato público del theme está en
[`docs/contrato-publico.md`](docs/contrato-publico.md). Todo cambio de slug, integración
o comportamiento documentado debe actualizar ese contrato en el mismo issue.
