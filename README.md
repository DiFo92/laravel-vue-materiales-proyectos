# Prueba Técnica Diego - Forero

Ejecutar las sentencias de código en **_terminal bash_**.

## Para usar de manera local:

Clonar el repositorio:

`git clone https://github.com/DiFo92/laravel-vue-materiales-proyectos.git`

Cambiar a directorio del proyecto

`cd laravel-vue-materiales-proyectos`

## Configuración Back

Descargar laradock para el ambiente back:

`git clone https://github.com/laradock/laradock.git`

Crear .env en laradock para laravel

`cd laradock`  
`cp .env.example .env`

#### Editar las siguientes variables de entorno de laradock para que se conecte a base de datos mysql:

`APP_CODE_PATH_HOST=../laravel-api/`  
...  
`MARIADB_VERSION=latest`  
`MARIADB_DATABASE=default`  
`MARIADB_USER=default`  
`MARIADB_PASSWORD=secret`  
`MARIADB_PORT=3306`  
`MARIADB_ROOT_PASSWORD=root`

---

Levantar nginx y mariadb de laradock

`docker-compose up nginx mariadb`

Ingresar al contendor y ejecutar migraciones y seeders

> `docker exec -it laradock-workspace-1 bash`
>
> - `php artisan migrate`
> - `php artisan db:seed`

## Configuración Front

### desplazarse al directorio del ambiente Front

_cd vuetify-idrd_

### Instalar **yarn**

`yarn install`

### Instalar librerias **axios y jspdf**

---

- `yarn add axios`
- `yarn add jspdf`

---

### niciar el ambiente de desarrollo de vuetify usando

`yarn dev`
