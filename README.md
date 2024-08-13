=======
# Sistema de Mantenimiento de Aeronaves
## Instalación

Tome en cuenta las siguientes instrucciones para inicializar y arrancar el proyecto Laravel.

Crear una base de datos en PostgreSQL. Luego en el archivo .env, modificar los siguientes parametros para conectarse a la BD:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nombreDeMiBd
DB_USERNAME=postgres
DB_PASSWORD=miContraseña
```

Despues, para crear el esquema de BD, ejecutar el comando:
```
php artisan migrate
```

Para rellenar datos iniciales del sistema, ejecutar:

```
php artisan db:seed
```

Para arrancar el sistema, ejecutar el comando:

```
php artisan serve
```

Para arrancar el sistema en una red (LAN por ejemplo), ejecutar el comando:

```
php artisan serve --host=192.168.1.4
```
