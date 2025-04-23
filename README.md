# Requisitos

- PHP 8.4
- MySQL 8.0
- Composer
- Docker

# Instalación

1. Instalar Docker.
2. Ejecutar el siguiente comando para crear un contenedor de Docker:

```bash
docker compose up -d
``` 

3. Instalar las dependencias del proyecto:

```bash
composer install
```

4. Crear un archivo de configuración de entorno `.env` en la raíz del proyecto y agregar las siguientes variables de
   entorno:

```
# Database Connection Details
DB_DRIVER=pdo_mysql
DB_USER=root
DB_PASS=REPLACE_WITH_DB_PASSWORD
DB_NAME=rentroad
DB_HOST=REPLACE_WITH_DB_HOST
DB_PORT=3306

# Application Environment Variables
ENVIRONMENT=development
```

> **Nota:** Asegúrate de reemplazar `REPLACE_WITH_DB_PASSWORD` y `REPLACE_WITH_DB_HOST` con la contraseña y el host de
> tu base de datos MySQL (ejecuta `docker ps` para ver el contenedor de la base de datos y su host).

5. Ejecuta el siguiente comando para crear la base de datos:

```bash
./cli db:update
```

6. Acceder a RentRoad en tu navegador:

```
http://127.0.0.1:3002
```

# Doctrine

## Proxy Clases

Utiliza el siguiente comando para borrar las clases proxy de Doctrine:

```bash
find /tmp -name "*.php*" -type f -delete
```