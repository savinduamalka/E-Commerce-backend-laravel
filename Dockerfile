# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install zip pdo pdo_mysql

# Copy application files
COPY . /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Run the Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
