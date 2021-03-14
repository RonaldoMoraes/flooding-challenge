FROM php:7.4-fpm-alpine

LABEL mantainer.name="Ronaldo R Moraes Jr"
LABEL mantainer.email=ronaldo.moraes1990@gmail.com

RUN set -x && \
    # Install main packages
    apk add --no-cache git tar zip unzip bash make curl wget vim && \
    # Install Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer


CMD ["php-fpm"]

EXPOSE 9000