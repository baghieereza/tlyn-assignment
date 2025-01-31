# Use the official PHP-FPM image
FROM php:8.2-fpm

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y \
    libpq-dev libonig-dev zip unzip curl \
    && docker-php-ext-install pdo pdo_mysql mbstring

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM process
CMD ["php-fpm"]
