# Utiliza la imagen oficial de PHP 8.3 como base
FROM php:8.3.7-fpm

# Instala Composer
RUN apt-get update && apt-get install -y zip unzip && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Instala el driver de MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Configura la zona horaria
RUN echo "America/Mexico_City" > /etc/timezone

# Establece el directorio de trabajo
WORKDIR /app

# Copia los archivos del proyecto al contenedor
COPY . /app

# Instala las dependencias del proyecto
RUN composer install --no-dev --prefer-dist

# Configura el entorno de ejecución
ENV COMPOSER_HOME=app/composer
ENV COMPOSER_CACHE_DIR=app/composer/cache
ENV APP_ENV=production
ENV APP_KEY=base64:t6BPvxple6iuJIDtx1eQVBlfZqJCebncJ8ZpU1IOp2Y=
ENV APP_DEBUG=false
ENV JWT_SECRET=ucmNHSkFCwsBET0oQdZyS42aLCVXCO9xQZxApPw0HheAiBTsxheE9u5vIijET8RA
ENV JWT_ALGO=HS256

# Configura el comando para ejecutar el servidor web
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

# Configura el servidor web
EXPOSE 8080