FROM mathewpeterson/php7:7.1.5-fpm

MAINTAINER Mathew Peterson <mathewpeterson@me.com>

ARG BUILD_DATE
ARG VERSION
ARG VCS_URL
ARG VCS_REF

LABEL org.label-schema.build-date=$BUILD_DATE \
      org.label-schema.name="Tania Web Application" \
      org.label-schema.description="Build artifact for Tania" \
      org.label-schema.url="http://gettania.org/" \
      org.label-schema.vcs-ref=$VCS_REF \
      org.label-schema.vcs-url="https://github.com/Tanibox/tania.git" \
      org.label-schema.vendor="Tania" \
      org.label-schema.version=$VERSION \
      org.label-schema.schema-version="1.0"

ADD . /var/www

VOLUME /var/www/var/cache
WORKDIR /var/www
