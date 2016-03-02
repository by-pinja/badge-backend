# set the base image first
FROM php:5.5-cli

# specify maintainer
MAINTAINER Tarmo Leppänen <tarmo.leppanen@protacon.com>

# Basics
RUN apt-get update && apt-get install -y git-core curl

# PHP stuff
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    && docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-install -j$(nproc) zip \
    && cp /usr/src/php/php.ini-production /usr/local/etc/php/php.ini \
    && sed -i "s/^;date.timezone =$/date.timezone = \"UTC\"/" /usr/local/etc/php/php.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create directory for application
RUN mkdir /var/www

# Copy all necessary stuff to docker
COPY . /var/www

# Install composer packages
RUN cd /var/www && composer install

# Create run-time folder and make it writable
RUN mkdir /var/www/var && chmod 777 -R /var/www/var

# And finally run PHP server
CMD php -S 0.0.0.0:80 -t /var/www/web
