FROM dunglas/frankenphp:1.7.0-php8.4.10-alpine

RUN apk add --update nodejs npm && \
    install-php-extensions \
    pcntl \
    redis \
    bcmath \
    xdebug \
    pdo \
    pdo_mysql && \
    echo 'memory_limit = 256M' > /usr/local/etc/php/conf.d/memory_limit.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/

COPY Caddyfile /
ENV XDEBUG_MODE=off

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--watch", "--poll", "--admin-host=0.0.0.0", "--port=80", "--caddyfile=/Caddyfile"]
