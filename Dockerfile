FROM php:8.2-apache

# 1. libzip muammosini hal qilish - avval kerakli package'larni o'rnatamiz
RUN apt-get update && apt-get install -y \
    wget \
    libzip-dev \
    zip \
    unzip

# 2. libzip ni to'g'ri versiyasini o'rnatish
RUN apt-get install -y libzip4

# 3. Boshqa dependencies
RUN apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# 4. PHP extensions - alohida qadamda
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache config - Laravel public folder uchun
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Laravel key generate
RUN php artisan key:generate --force

# Cache clear
RUN php artisan config:clear

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Enable Apache modules
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]
