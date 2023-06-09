# Base image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libpq-dev \
    zip \
    unzip \
    git

# Install PHP extensions
RUN docker-php-ext-install \
    intl \
    mbstring \
    pdo \
    pdo_pgsql

# Configura el DocumentRoot de Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-autoloader

# Copy application code
COPY . /var/www/html

# Establece los permisos adecuados para los archivos del proyecto
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/var

# Copia la configuración del virtual host de Apache
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Habilita el sitio de Apache
RUN a2ensite 000-default

# Generate optimized Composer autoloader
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Reinicia el servicio de Apache
RUN service apache2 restart

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
