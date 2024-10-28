#!/bin/bash

# Verificar si la carpeta storage no existe
docker exec -it tulook_api chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Verificar si la carpeta storage no existe
docker exec -it tulook_api chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Verificar si la carpeta vendor no existe
docker exec -it tulook_api sh -c 'if [ ! -d "vendor" ]; then composer install --optimize-autoloader; fi'

# Verificar si el archivo .env no existe y copiar .env.txt como .env
docker exec -it tulook_api sh -c 'if [ ! -f ".env" ]; then cp .env.example .env; fi'

# Mensaje de finalización
echo "Inicialización completada."

# Reiniciar el contenedor
docker restart tulook_api