# Usa la imagen de PHP 8.3 con Apache
FROM php:8.3-apache

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

# Habilita el módulo rewrite de Apache
RUN a2enmod rewrite

# Establece el DocumentRoot en /public
RUN echo "DocumentRoot /var/www/html/public" >> /etc/apache2/sites-available/000-default.conf

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el código del proyecto Laravel al contenedor
COPY . /var/www/html

# Da permisos a los directorios necesarios de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el archivo .env.example al contenedor
COPY .env.example .env

# Instala dependencias de Laravel
RUN composer install

# Genera la clave de la aplicación
RUN php artisan key:generate

# Genera la key del JWT
RUN php artisan jwt:secret

# Expone el puerto 80 para Apache
EXPOSE 80
