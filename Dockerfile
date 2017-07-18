FROM php:7.1-fpm
RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libmcrypt-dev \
		libpng12-dev \
    git \
	&& docker-php-ext-install -j$(nproc) \
    iconv \
    mcrypt \
    zip \
    mysqli \
    pdo_mysql \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd

RUN pecl install apcu \
    && pecl install apcu_bc-1.0.3 \
    && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini \
    && docker-php-ext-enable apc --ini-name 20-docker-php-ext-apc.ini
ADD . /tania
WORKDIR /tania
ENV COMPOSER_NO_INTERACTION=1 COMPOSER_ALLOW_SUPERUSER=1
RUN cp /tania/app/config/parameters.yml.dist /tania/app/config/parameters.yml
RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar install
RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/*
