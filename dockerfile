# Use official PHP 8.2 Apache image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy your Laravel app (including pre-built vendor)
COPY . .

# Ensure storage and bootstrap/cache are writable
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80 for Render or Docker
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
