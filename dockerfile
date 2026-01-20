# Use PHP 8.2 FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo_mysql mbstring bcmath tokenizer xml gd zip \
    && rm -rf /var/lib/apt/lists/*

# Copy app files
COPY . .

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies inside container
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Ensure storage & bootstrap/cache are writable
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port Render expects
EXPOSE 8080

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
