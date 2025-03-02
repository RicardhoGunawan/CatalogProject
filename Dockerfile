FROM php:8.3.18RC1-fpm-alpine3.21

# Install dependensi yang dibutuhkan
RUN apk add --no-cache icu-dev

# Install ekstensi PHP yang dibutuhkan Laravel
RUN docker-php-ext-configure intl && docker-php-ext-install intl pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy project Laravel ke dalam container
COPY . .

# Set permission untuk Laravel
RUN chmod -R 777 storage bootstrap/cache

CMD ["php-fpm"]
