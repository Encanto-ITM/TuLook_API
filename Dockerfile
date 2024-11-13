# Usa la imagen de PHP 8.3 con FPM
FROM php:8.3-fpm

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el código del proyecto Laravel al contenedor
COPY . /var/www/html

# Da permisos a los directorios necesarios de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Da permisos a los directorios necesarios de Laravel
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el archivo .env.example al contenedor
COPY .env.example .env

# Instala dependencias de Laravel
RUN composer install --optimize-autoloader

# Genera la clave de la aplicación
RUN php artisan key:generate

# Genera la key del JWT
RUN php artisan jwt:secret

# Busca en el archivo Models/User.php y remplaza tulook.vercel.app por 3.21.19.209:80
RUN sed -i 's/tulook.vercel.app/3.21.19.209:80/g' /var/www/html/app/Models/User.php

# Expone el puerto 9000 para PHP-FPM
EXPOSE 9000