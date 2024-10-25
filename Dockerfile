FROM php:8.3-fpm

# Configure timezone
RUN echo "America/Costa_Rica" > /etc/timezone && \
    dpkg-reconfigure -f noninteractive tzdata

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql
    # php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    # php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    # php -r "unlink('composer-setup.php');"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/tulook

COPY . .

RUN composer install

RUN chown -R www-data:www-data /var/www/tulook

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
# CMD ["php", "artisan", "serve", "--host=0.0.0.0" , "--port=9000"]