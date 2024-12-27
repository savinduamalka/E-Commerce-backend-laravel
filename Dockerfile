<<<<<<< HEAD
# Use the official PHP image with Apache
FROM php:8.2-apache
=======
FROM php:8.2-fpm
>>>>>>> cd8eb182adbdbffea0d1643442c521ebce72b1d7

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

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Copy application files
COPY . /var/www/html

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy existing application permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

<<<<<<< HEAD
# Disable default apache config if exists
RUN a2dissite 000-default.conf || true

# Copy your apache config
COPY your-domain.conf /etc/apache2/sites-available/your-domain.conf

RUN a2ensite your-domain.conf
# Add listen to ports.conf
RUN echo "Listen 80" >> /etc/apache2/ports.conf
RUN echo "Listen *:80" >> /etc/apache2/ports.conf

# Restart Apache 
RUN service apache2 restart

# Expose port 80 for HTTP requests
EXPOSE 80
=======
# Configure Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Enable Nginx
RUN ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# Expose port 80 for HTTP requests
EXPOSE 80

# Start Nginx and PHP-FPM
CMD ["nginx", "-g", "daemon off;"]
>>>>>>> cd8eb182adbdbffea0d1643442c521ebce72b1d7
