# laravel-vue-materiales-proyectos

## Para usar de manera local:

1. Descargar este repositorio:

git clone https://github.com/DiFo92/laravel-vue-materiales-proyectos.git

2. Cambiar a directorio del proyecto

cd laravel-vue-materiales-proyectos

### Configuración Back

3. Descargar laradock para el ambiente back:

git clone https://github.com/laradock/laradock.git

4. Crear .env en laradock para laravel
   cd laradock
   cp .env.example .env

5. Editar las siguientes variables de entorno de laradock para que se conecte a base de datos mysql:

#########################
APP_CODE_PATH_HOST=../laravel-api/
#########################
MARIADB_VERSION=latest
MARIADB_DATABASE=default
MARIADB_USER=default
MARIADB_PASSWORD=secret
MARIADB_PORT=3306
MARIADB_ROOT_PASSWORD=root
#########################

6. Levantar nginx y mariadb de laradock

docker-compose up nginx mariadb

7. Ingresar al contendor y ejecutar migraciones y seeders

- docker exec -it laradock-workspace-1 bash
- php artisan migrate
- php artisan db:seed

## Configuración Front

### desplazarse al directorio del ambiente Front

_cd vuetify-idrd_

### Tener instalado **yarn** en la maquina

yarn install

### Instalar librerias **axios y jspdf**

---

- yarn add axios
- `yarn add jspdf`

---

### iniciar el ambiente de desarrollo de vuetify usando yarn

`yarn dev`
