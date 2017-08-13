FROM nginx:alpine

ARG BUILD_DATE

LABEL org.label-schema.build-date=$BUILD_DATE \
      org.label-schema.name="Tania Reverse Proxy and Static File Server" \
      org.label-schema.description="Build artifact for Tania" \
      org.label-schema.url="http://gettania.org/" \
      org.label-schema.vcs-ref=$VCS_REF \
      org.label-schema.vcs-url="https://github.com/Tanibox/tania.git" \
      org.label-schema.vendor="Tania" \
      org.label-schema.version="1.1-beta" \
      org.label-schema.schema-version="1.0"

RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

ADD ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
ADD . /var/www
