FROM php:8.5-apache
###> recipes ###
###< recipes ###
RUN a2enmod rewrite
RUN apt-get update \
    && apt-get install -y libzip-dev git wget --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql zip;
COPY docker/apache.conf /etc/apache2/sites-enabled/000-default.conf 
COPY docker/entrypoint.sh /entrypoint.sh
COPY . /var/www
WORKDIR /var/www
RUN composer install -n
RUN chown -R www-data:www-data /var/www/var/log /var/www/var/cache