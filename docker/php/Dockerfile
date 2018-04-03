FROM php:7.2-fpm
MAINTAINER Pierre Tachoire <pierre@wisembly.com>

ARG uid
ARG gid

# composer
# see https://getcomposer.org/download/
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --filename=composer --install-dir=/usr/local/bin \
    && php -r "unlink('composer-setup.php');"

RUN sed -i "s/33:33/$uid:$gid/g" /etc/passwd \
    && sed -i "s#/var/www#/home/www-data#g" /etc/passwd \
    && sed -i "s/33/$gid/g" /etc/group

RUN mkdir /home/www-data \
    && chown -R www-data: /home/www-data

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    postgresql-server-dev-all

RUN docker-php-ext-install \
    pgsql \
    pdo_pgsql

RUN apt-get remove -y \
    postgresql-server-dev-all \
    && rm -rf /var/lib/apt/lists/*

COPY entrypoint /usr/local/bin/run

ENTRYPOINT ["run"]

WORKDIR /srv
