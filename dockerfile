# Use PHP 8.2 FPM (latest stable)
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && \
    apt-get install -y git unzip zip curl libzip-dev libonig-dev libxml2-dev pkg-config \
    libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql mbstring bcmath tokenizer xml gd zip && \
    rm -rf /var/lib/apt/lists/*

# Copy composer from official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the project files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Install Node.js and npm via NodeSource for Tailwind/Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install && \
    npm run build && \
    rm -rf /var/lib/apt/lists/*

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose Render’s required port
EXPOSE 8080

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
