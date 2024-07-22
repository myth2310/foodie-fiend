# Menggunakan image PHP 8.1 resmi
FROM php:8.1-fpm

# Install extensions yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Salin konfigurasi php.ini
COPY php.ini /usr/local/etc/php/

# Set working directory
WORKDIR /var/www

# Copy seluruh project ke dalam container
COPY . .

# Set izin pada direktori writable
RUN chown -R www-data:www-data /var/www/writable

# Expose port 9000 dan menjalankan PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
