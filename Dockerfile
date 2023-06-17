FROM php:7.4-apache
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer
RUN a2enmod rewrite
RUN apt-get update -y && apt-get install -y git libicu-dev unzip zip libpng-dev zlib1g-dev libzip-dev
RUN docker-php-ext-install intl opcache pdo_mysql sockets gd zip exif
ENV OPCACHE_VALIDATE_TIMESTAMPS=0
WORKDIR /var/www/html
COPY . .
COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY memory_limit.ini /usr/local/etc/php/conf.d/memory_limit.ini
RUN composer i -n -o --prefer-dist
RUN chmod -R 777 storage/logs
EXPOSE 80 6001
