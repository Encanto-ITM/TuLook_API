FROM php:8.3.7-fpm

# Install MySQL driver and necessary extensions
RUN docker-php-ext-install pdo pdo_mysql

# Configure timezone
RUN echo "America/Costa_Rica" > /etc/timezone && \
    dpkg-reconfigure -f noninteractive tzdata

# Set working directory
WORKDIR /tulook

# Copy project files into container
COPY . /tulook

# Install Composer
RUN apt-get update && apt-get install -y zip unzip && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Create vendor directory 
RUN mkdir vendor

# Install dependencies
RUN composer install
# RUN composer install --no-dev && composer --version

# Set command to run web server
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

# Expose port
EXPOSE 8000