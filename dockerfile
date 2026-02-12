# Use PHP 8.2 FPM
FROM php:8.2-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl nano \
    libzip-dev libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libcurl4-openssl-dev libssl-dev pkg-config \
    libpq-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_pgsql mbstring bcmath xml gd zip \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Clear caches (VERY IMPORTANT)
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear

# Storage dirs (Render-safe)
RUN mkdir -p storage/framework/{cache,sessions,views} \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

# Storage link
RUN php artisan storage:link || true

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
