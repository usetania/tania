FROM tanibox/php7-fpm-nginx-supervisord

MAINTAINER Didiet Noor <dnor@tanibox.com>

ARG BUILD_DATE

LABEL org.label-schema.build-date=$BUILD_DATE \
      org.label-schema.name="Tania Web Application" \
      org.label-schema.description="Build artifact for Tania" \
      org.label-schema.url="http://gettania.org/" \
      org.label-schema.vcs-ref=$VCS_REF \
      org.label-schema.vcs-url="https://github.com/Tanibox/tania.git" \
      org.label-schema.vendor="Tania" \
      org.label-schema.version="1.2-beta" \
      org.label-schema.schema-version="1.0"

ADD . /var/www
COPY ./docker/app/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/app/tania-entrypoint /usr/local/bin/
VOLUME /var/www/var/cache
WORKDIR /var/www

RUN  touch /var/www/.env \
      && COMPOSER_ALLOW_SUPERUSER=1 composer install --no-autoloader --no-scripts --no-dev 

ENTRYPOINT [ "/usr/local/bin/tania-entrypoint" ]
