# ---------- PHP ----------
FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip zip curl nodejs npm \
    libzip-dev libonig-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo_pgsql mbstring bcmath xml gd zip \
    && rm -rf /var/lib/apt/lists/*

# Copy app
COPY . .

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 🔥 BUILD TAILWIND
RUN npm install
RUN npm run build

# Clear caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080

CMD php artisan migrate --force && \
    php artisan queue:work --daemon --tries=3 --timeout=90 & \
    while true; do php artisan schedule:run --no-interaction; sleep 60; done & \
    php artisan serve --host=0.0.0.0 --port=$PORT

