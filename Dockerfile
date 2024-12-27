FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Copy application files
COPY . /var/www

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy existing application permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Configure Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Enable Nginx
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# Expose port 80 for HTTP requests
EXPOSE 80

# Start Nginx and PHP-FPM
CMD ["nginx", "-g", "daemon off;"]