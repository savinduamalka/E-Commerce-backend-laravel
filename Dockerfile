# Use the official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

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

# Copy application files
COPY . /var/www/html

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy existing application permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Disable default apache config if exists
RUN a2dissite 000-default.conf || true

# Copy your apache config
COPY your-domain.conf /etc/apache2/sites-available/your-domain.conf

RUN a2ensite your-domain.conf

# Restart Apache 
RUN service apache2 restart

# Expose port 80 for HTTP requests
EXPOSE 80
