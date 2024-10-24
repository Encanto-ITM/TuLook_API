# Utiliza la imagen oficial de PHP 8.3 como base
FROM php:8.3.7-fpm

# Configura la zona horaria
RUN echo "America/Costa_Rica" > /etc/timezone && \
    dpkg-reconfigure -f noninteractive tzdata

# Establece el directorio de trabajo
WORKDIR /app

# Copia los archivos del proyecto al contenedor
COPY . /app

# Instala Composer
RUN apt-get update && apt-get install -y zip unzip docker-php-ext-install && \
    libonig-dev libzip-dev pdo pdo_mysql && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Instala las dependencias
RUN composer install

# Configura el entorno de ejecución
# COPY .env /app/.env

# Configura el comando para ejecutar el servidor web
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

# Configura el servidor web
EXPOSE 8000