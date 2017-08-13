FROM nginx:alpine
RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

ADD ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
ADD . /var/www
