# Use official PHP 8.2 Apache image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app including vendor
COPY . .

# Ensure storage and bootstrap/cache are writable
RUN chown -R www-data:www-data storage bootstrap/cache

# Enable Apache rewrite module for Laravel routing
RUN a2enmod rewrite

# Set Apache DocumentRoot to Laravel's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80 for Render
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
