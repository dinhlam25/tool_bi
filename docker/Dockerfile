FROM php:8.3-fpm-alpine

RUN apk add wget git iputils-ping net-tools vim nodejs npm figlet

# installing required extensions
RUN apk add bash build-base gcc autoconf libmcrypt-dev libzip-dev zip g++ make openssl-dev

RUN docker-php-ext-install opcache mysqli pdo pdo_mysql

RUN apk add tzdata && ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy PHP configuration
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

#Xdebug
#RUN apk add --update linux-headers & pecl install xdebug && docker-php-ext-enable xdebug
#COPY ./docker/php/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY ./laravel /opt/html

WORKDIR /opt/html

RUN composer install --no-progress --no-interaction
RUN npm install