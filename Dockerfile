# composer dependencies
FROM composer:2.4 as build

# copy semua file ke dalam folder app
COPY . /app/

# composer install/update
RUN composer update --prefer-dist --no-dev --optimize-autoloader --no-interaction

#dependcies as development
FROM php:8.1-apache-buster as dev

# setting environment
ENV APP_ENV=dev
ENV APP_DEBUG=true
ENV COMPOSER_ALLOW_SUPERUSER=1

#update os && install zip
RUN apt-get update && apt-get install -y zip

#install depencies
RUN docker-php-ext-install pdo pdo_mysql

# copy seluruh folder ke folder html
COPY . /var/www/html/

#copy file composer
COPY --from=build /usr/bin/composer /usr/bin/composer

# install composer lagi
RUN composer update --prefer-dist --no-interaction

#copy file dari folder docker/apache2 ke OS di /etc/apache2/sites-available
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY .env.dev /var/www/html/.env

RUN php artisan config:cache && \
     php artisan route:cache && \
     chmod 777 -R /var/www/html/storage/ && \
     chown -R www-data:www-data /var/www/ && \
     a2enmod rewrite


#     FROM php:7.4-apache
# .....
# ARG user_id=1000
# RUN usermod -u $user_id www-data