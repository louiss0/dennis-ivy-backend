FROM php:8.0-fpm-alpine


WORKDIR /var/www/html/  

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd xdebug
RUN apk update && apk add postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql

