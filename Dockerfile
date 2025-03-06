FROM node:18-alpine AS tailwind
WORKDIR /var/www

COPY . .
RUN npm install && npm run build


FROM php:8.3.1-fpm-alpine3.19

# dependensi 
RUN apk add --no-cache icu-dev zip unzip libzip-dev 

# ekstensi Laravel
RUN docker-php-ext-configure zip && docker-php-ext-configure intl && docker-php-ext-install intl zip pdo pdo_mysql
RUN wget https://github.com/composer/composer/releases/download/2.8.6/composer.phar -O /composer
 RUN chmod +x /composer


# Set working directory
WORKDIR /var/www

COPY . .

COPY --from=tailwind /var/www/public/build /var/www/public/build
RUN /composer install

# et permission Laravel
RUN chmod -R 777 storage bootstrap/cache

CMD ["php-fpm"]
