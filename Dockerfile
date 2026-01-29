FROM php:8.2-apache

# Step 1: Update and install basic packages
RUN apt-get update

# Step 2: Install libzip dependencies (libzip5 is already installed with libzip-dev)
RUN apt-get install -y libzip-dev zip unzip

# Step 3: Install other required packages
RUN apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# Step 4: Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql mbstring gd zip

# Step 5: Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Step 6: Configure Apache for Laravel
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Step 7: Set working directory and copy files
WORKDIR /var/www/html
COPY . .

# Step 8: Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Step 9: Generate Laravel key
RUN php artisan key:generate --force

# Step 10: Set permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
