# Tulook_API

Este es un repositorio creado con Laravel para la creación y modificación de la API que va a funcionar como intermediario entre la app y la base de datos
Esta es una API orientada a un proyecto llamdo TuLook, que va ser desarrollado para la carrera de ITM de la Universidad de Costa Rica.

## Integrantes:

+ Eddy Chaves,
+ Estefania Jimenez Cordero,
+ Ian Miranda,
+ Juan Camacho Sanchez,
+ Keyler Ibarra

## Requerimientos:

### PHP:

- Opción 1:
  - Instalacion de php local:
    1. Descargar [PHP.zip](https://windows.php.net/downloads/releases/php-8.3.11-Win32-vs16-x64.zip)
    2. Crear una carpeta en el disco local `C:\` con el nombre de `PHP`
    3. Descomprimir todos los archivos que queden dentro de la carpeta (solo los archivos)
    4. Buscar variables de entorno, en `PATH` crear una nueva y colocar `C:\php`
    5. Para mas referencia, guiarse con [este video](https://www.youtube.com/watch?v=3tnb9FuWfpU)
- Opción 2:
  - Usar [XAMP](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.0.30/xampp-windows-x64-8.0.30-0-VS16-installer.exe)
- Opción 3:
  - Usar [Laragon](https://github.com/leokhoa/laragon/releases/download/6.0.0/laragon-wamp.exe)

#### PHP cofiguraciones necesarias:

- Ejecutar en cmd `C:\php\php.ini` el cual abrirá un archivo `.txt` cons los ajustes de php, debe eliminar el `;` de las siguientes lineas.

+ Para instalacion de composer:

```txt
; extension=zip
; extension=fileinfo
```

+ Para configurar mysql

```txt
; extension=mysqli
; extension=pdo_mysql
```

### Instalar Composer:

- [Composer.exe](https://getcomposer.org/Composer-Setup.exe)

_Si no se ejecuta al iniciar.
Dentro de la carpeta del proyecto ejecutamos el siguiente comando._

```bash
composer install
```

### Configuracion del `.env`

- Copiar el archivo .env.example con el comando

```bash
copy .env.example .env 
```

- Dentro de `.env` configurarlo con las variables correspondientes.

```.env
APP_NAME=TuLook_API
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost
```

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=330
DB_DATABASE=tulook_db
DB_USERNAME={your_user}
DB_PASSWORD={your_password}
```

### Ejecución del proyecto

Una vez creado el `.env`, ejecutamos los siguientes comandos:

- Para crear la llave:

```bash
php artisan key:generate
```

- Para crear las migraciones:

```bash
php artisan migrate
```

- Para ejecutar el proyecto:

```bash
php artisan serve
```

> _Si el proyecto no se ejecuta, pregunte a los compañeros_

## Consideraciones para trabajar:

- Para este proyecto se ha decidido utilizar una libreria que facilita la creacion de la API, que seria: [laravel-crud-generator](https://github.com/awais-vteams/laravel-crud-generator?tab=readme-ov-file).
