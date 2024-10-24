# Utiliza la imagen oficial de PHP 8.3 como base
FROM php:8.3.7-fpm

# Instala Composer
# RUN apt-get update && apt-get install -y zip unzip && \
#     php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
#     php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
#     php -r "unlink('composer-setup.php');"

# Instala el driver de MySQL y extensiones necesarias para JWT
RUN docker-php-ext-install pdo pdo_mysql

# Configura la zona horaria
RUN echo "America/Costa_Rica" > /etc/timezone && \
    dpkg-reconfigure -f noninteractive tzdata

# Establece el directorio de trabajo
WORKDIR /app

# Copia los archivos del proyecto al contenedor
COPY . /app

# Instala Composer (si no está en tu imagen base)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala las dependencias
RUN composer install

# Configura el entorno de ejecución
# COPY .env /app/.env

# Configura el comando para ejecutar el servidor web
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

# Configura el servidor web
EXPOSE 8000