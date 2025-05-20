FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip


RUN a2enmod rewrite


WORKDIR /var/www/html


COPY . .


RUN cp -r bootstrap/public public


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


RUN composer install --no-dev --optimize-autoloader


RUN chown -R www-data:www-data storage bootstrap/cache


RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf


RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

EXPOSE 80

CMD ["apache2-foreground"]

CMD ["apache2-foreground"]
