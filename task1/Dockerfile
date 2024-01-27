FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

WORKDIR /var/www
RUN composer install

RUN chown -R www-data:www-data /var/www/storage


ENV DB_CONNECTION=pgsql
ENV DB_DATABASE=task1
ENV DB_USERNAME=aris
ENV DB_PASSWORD=password
ENV AUTH_TOKEN=OktIGTnlJlvjdzeMcKTlcuTsF

CMD ["php-fpm"]
