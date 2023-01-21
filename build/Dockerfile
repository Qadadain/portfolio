FROM php:8.2-fpm-bullseye AS base

ENV APP_ENV prod

RUN apt-get update --assume-yes && apt-get install --no-install-recommends --assume-yes \
    nginx \
    libicu-dev \
 && docker-php-ext-install intl pdo_mysql opcache \
 && rm -rf /var/www/html/ \
 && mkdir /var/www/html/ && chown www-data /var/www/html/ \
 && cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
 && sed -i 's|listen = 9000|listen = /var/server/php-fpm.sock|' /usr/local/etc/php-fpm.d/zz-docker.conf \
 && echo 'listen.owner = www-data' >> /usr/local/etc/php-fpm.d/zz-docker.conf \
 && echo 'listen.group = www-data' >> /usr/local/etc/php-fpm.d/zz-docker.conf \
 && echo 'listen.mode = 0600' >> /usr/local/etc/php-fpm.d/zz-docker.conf \
 && sed -i 's/expose_php = */expose_php = Off/g' /usr/local/etc/php/php.ini \
 && sed -i '/^user = *\|^group = */d' /usr/local/etc/php-fpm.d/www.conf

COPY ./build/default.conf /etc/nginx/conf.d/default.conf
COPY ./build/nginx.conf /etc/nginx/nginx.conf

RUN sed -i 's/user www-data;/#user www-data;/' /etc/nginx/nginx.conf

########################################################################################################################

FROM base AS composer

WORKDIR /code

RUN apt update && apt install --no-install-recommends --assume-yes curl git libzip-dev openssl unzip zip \
 && docker-php-ext-install zip \
 && chown -R www-data:www-data .

USER www-data

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

COPY --chown=www-data:www-data composer.* .
COPY --chown=www-data:www-data symfony.lock .

RUN composer install --audit --prefer-dist --no-dev --no-autoloader --no-progress --no-scripts --no-interaction

COPY --chown=www-data:www-data src ./src
RUN composer dump-autoload --strict-psr --no-dev --optimize --classmap-authoritative --no-interaction

########################################################################################################################

FROM node:19.4-alpine3.17 AS node

WORKDIR /code

COPY ./assets ./assets
COPY ./postcss.config.js ./postcss.config.js
COPY ./tailwind.config.js ./tailwind.config.js
COPY ./package.json ./package.json
COPY ./package-lock.json ./package-lock.json
COPY ./webpack.config.js ./webpack.config.js

RUN npm ci && npm run build

########################################################################################################################

FROM base AS final

ENV APP_ENV=prod

WORKDIR /var/www/html

RUN docker-php-ext-install opcache \
 && echo 'opcache.preload=/var/www/html/config/preload.php' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo 'opcache.preload_user=www-data' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo 'opcache.memory_consumption=256' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo 'opcache.max_accelerated_files=20000' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo 'opcache.validate_timestamps=0' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo 'realpath_cache_size=4096K' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && echo 'realpath_cache_ttl=6000' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

COPY --chown=www-data:www-data bin /var/www/html/bin
COPY --chown=www-data:www-data config /var/www/html/config
COPY --chown=www-data:www-data public /var/www/html/public
COPY --chown=www-data:www-data src /var/www/html/src
COPY --chown=www-data:www-data templates /var/www/html/templates
COPY --chown=www-data:www-data translations /var/www/html/translations
COPY --from=composer --chown=www-data:www-data /code/vendor /var/www/html/vendor
COPY --from=node --chown=www-data:www-data /code/public/build /var/www/html/public/build
COPY --chown=www-data:www-data /build/post_deploy.sh /post_deploy.sh

ENV DATABASE_URL=''

RUN php bin/console cache:warmup \
 && mkdir /var/server \
 && touch /var/server/nginx.pid \
 && touch /var/server/php-fpm.sock \
 && chown -R www-data:www-data /etc/nginx/conf.d/ \
 && chown -R www-data:www-data /var/server \
 && chown -R www-data:www-data /var/www \
 && nginx -t \
 && chmod u+x /post_deploy.sh

USER www-data

CMD [ "sh", "/post_deploy.sh" ]

########################################################################################################################

FROM final as dev

USER root

ENV APP_ENV=dev

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \
 && sed -i 's|variables_order = "GPCS"|variables_order = "EGPCS"|' /usr/local/etc/php/php.ini \
 && curl -fsSL https://deb.nodesource.com/setup_19.x | bash - \
 && apt-get update --assume-yes \
 && apt-get install --no-install-recommends --assume-yes git libzip-dev nodejs=19.4.0-* unzip zip \
 && docker-php-ext-install zip \
 && rm -rf /var/lib/apt/lists/* \
 && rm -f /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
 && sed -i 's/#user www-data;/user www-data;/' /etc/nginx/nginx.conf \
 && echo 'user = www-data' >> /usr/local/etc/php-fpm.d/www.conf \
 && echo 'group = www-data' >> /usr/local/etc/php-fpm.d/www.conf
