ARG ALPINE_VERSION=3.16

FROM php:8.1-cli-alpine$ALPINE_VERSION AS php-cli

RUN apk update && apk upgrade\
   wget

RUN apk add php make --update

WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json ./
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install --prefer-dist --no-progress --no-suggest --no-interaction --no-plugins --ignore-platform-reqs

COPY dev/docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]

CMD ["php"]