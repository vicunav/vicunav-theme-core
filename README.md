# Plantilla de repositorio de GitHub

Este repositorio es un punto de partida reutilizable para nuevos repositorios de GitHub. Crear un repositorio a partir de esta plantilla copia sus archivos y estructura de directorios en un repositorio nuevo e independiente, sin tratarlo como un fork.

## Crear un repositorio a partir de esta plantilla

1. Abre este repositorio de plantilla en GitHub.
2. Selecciona **Use this template** y luego **Create a new repository**.
3. Elige el propietario, el nombre del repositorio, la descripción y la visibilidad.
4. Selecciona **Create repository**.
5. Clona el nuevo repositorio, incluidos sus submódulos:

   ```bash
   git clone --recurse-submodules https://github.com/OWNER/REPOSITORY.git
   cd REPOSITORY
   ```

Si el repositorio se clonó sin submódulos, inicialízalos después:

```bash
git submodule update --init --recursive
```

Después de crear el repositorio, reemplaza este README con documentación específica del proyecto y configura las herramientas, los permisos y las protecciones de ramas que requiera el nuevo proyecto.

Para obtener más información, consulta la guía de GitHub para [crear un repositorio a partir de una plantilla](https://docs.github.com/en/repositories/creating-and-managing-repositories/creating-a-repository-from-a-template).
