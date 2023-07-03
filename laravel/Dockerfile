FROM php:8.1-apache

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
RUN apt-get update -y && apt-get install -y nodejs

# Install composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install necessary dependencies
RUN apt-get update -y && apt-get install -y git libicu-dev unzip zip libpng-dev zlib1g-dev libzip-dev

# Install PHP extensions
RUN docker-php-ext-install intl opcache pdo_mysql sockets gd zip exif

# Set OPCache configuration
ENV OPCACHE_VALIDATE_TIMESTAMPS=0

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app files
COPY . .

# Copy Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP configuration files
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY memory_limit.ini /usr/local/etc/php/conf.d/memory_limit.ini

# Install PHP dependencies using Composer
RUN composer i -n -o --prefer-dist

# Set permissions for Laravel storage/logs directory
RUN chmod -R 777 storage/logs

# Copy Vite configuration
COPY vite.config.js /var/www/html/vite.config.js

# Expose ports
EXPOSE 80 6001
EXPOSE 5173 5173

# Start the development server using Vite
# CMD ["npm", "run", "dev"]
