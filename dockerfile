# Use latest PHP FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install only required PHP extensions
RUN apt-get update && \
    apt-get install -y git unzip libzip-dev libonig-dev libxml2-dev pkg-config && \
    docker-php-ext-install pdo_mysql mbstring bcmath tokenizer xml zip && \
    rm -rf /var/lib/apt/lists/*

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Set permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port required by Render
EXPOSE 8080

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
