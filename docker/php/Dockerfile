FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
        apt-utils \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        zip unzip \
        libmagickwand-dev \
        graphicsmagick \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        zlib1g-dev \
        git && \
        pecl install imagick && \
        docker-php-ext-enable imagick && \
        docker-php-ext-install pdo mysqli pdo_mysql && \
        docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/&& \
        docker-php-ext-install -j$(nproc) gd &&\
        docker-php-ext-enable gd &&\
        docker-php-ext-install bcmath && \
        docker-php-ext-install zip && \
        apt-get clean && \
        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

RUN chmod -v 1777 /tmp /var/tmp

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin \

#RUN ln -s /app/storage /app/public/storage

WORKDIR /var/www

#ENTRYPOINT ["sh", "entrypoint.sh" ]
