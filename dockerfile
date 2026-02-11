# Use PHP 8.2 FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libcurl4-openssl-dev libssl-dev pkg-config nano \
    default-mysql-client libpq-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring bcmath xml gd zip \
    && rm -rf /var/lib/apt/lists/*

# Copy Laravel app
COPY . .

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Clear Laravel caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Fix symbolic link issue if it already exists
RUN if [ -L "public/storage" ] || [ -e "public/storage" ]; then rm -rf public/storage; fi \
    && php artisan storage:link

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose Laravel port
EXPOSE 8080

# Run migrations on container start and start server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
