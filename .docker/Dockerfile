FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt update && apt install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libicu-dev \
        libpq-dev \
        libxpm-dev \
        libvpx-dev \
        libzip-dev \
#        git \
#        postgresql-client-15\
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) pgsql \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-ext-install -j$(nproc) exif \
#    && docker-php-ext-install -j$(nproc) git \
#    && docker-php-ext-configure gd \
#        --with-freetype-dir=/usr/include/ \
#        --with-jpeg-dir=/usr/include/ \
#        --with-xpm-dir=/usr/lib/x86_64-linux-gnu/ \
#        --with-vpx-dir=/usr/lib/x86_64-linux-gnu/ \

#RUN curl -s "https://laravel.build/example-app" | bash
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN git init /var/www/html

#COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

#RUN composer install \
#    --no-interaction \
#    --no-plugins \
#    --no-scripts \
#    --no-dev \
#    --prefer-dist

#COPY . .
#RUN composer dump-autoload

# Install composer
#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
#    && php composer-setup.php \
#    && php -r "unlink('composer-setup.php');" \
#    && mv composer.phar /usr/local/bin/composer


# Add UID '1000' to www-data
#RUN usermod -u 1000 www-data

# Copy existing application directory permissions
#COPY --chown=www-data:www-data . /var/www/html

# Change current user to www
USER www-data

EXPOSE 80

CMD ["php-fpm"]
