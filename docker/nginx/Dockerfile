FROM debian:jessie

RUN apt-get update && apt-get install -y \
    nginx

ADD docker/nginx/nginx.conf /etc/nginx/
ADD docker/nginx/api.conf /etc/nginx/sites-available/
ADD docker/nginx/panel.conf /etc/nginx/sites-available/

COPY www/api/public/bundles /var/www/html/api/public/bundles
COPY www/panel/public/bundles /var/www/html/panel/public/bundles

RUN ln -s /etc/nginx/sites-available/panel.conf /etc/nginx/sites-enabled/panel \
&& ln -s /etc/nginx/sites-available/api.conf /etc/nginx/sites-enabled/api \
&& rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 80
EXPOSE 443