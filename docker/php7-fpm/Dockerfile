FROM php:7.2-fpm
ARG TIMEZONE

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql

COPY www/api /var/www/html/api
COPY www/panel /var/www/html/panel

WORKDIR /var/www/html/api

RUN composer install

RUN chmod -R 777 /var/www/html/api/var

WORKDIR /var/www/html/panel

RUN composer install

RUN chmod -R 777 /var/www/html/panel/var

WORKDIR /var/www/html