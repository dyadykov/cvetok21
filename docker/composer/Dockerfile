FROM composer:latest

RUN apk update \
&& apk add zlib-dev libzip-dev libpng-dev \
&& docker-php-ext-install gd zip

COPY ./app /app

WORKDIR /app

RUN php init --env=Development --overwrite=All
