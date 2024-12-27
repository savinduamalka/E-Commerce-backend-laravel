# Use an official PHP image with Apache
FROM php:8.1-apache

# Set the working directory to the Laravel app
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files to the container
COPY . /var/www/html


# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 (default for web apps)
EXPOSE 80

# Start the Laravel application using artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
