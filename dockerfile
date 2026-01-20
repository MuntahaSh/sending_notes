# Pre-built Laravel-ready PHP image
FROM laravelsail/php80-composer:latest

WORKDIR /var/www/html

# Copy your Laravel app
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Ensure storage and cache directories are writable
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port for Render
EXPOSE 8080

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
