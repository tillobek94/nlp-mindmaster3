FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql mbstring gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache config
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

WORKDIR /var/www/html
COPY . .

# Ensure .env exists
RUN if [ ! -f .env ]; then \
    if [ -f .env.example ]; then \
        cp .env.example .env; \
    else \
        echo "APP_KEY=" > .env; \
    fi; \
    fi

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate app key if not set
RUN if grep -q 'APP_KEY=' .env && ! grep -q 'APP_KEY=base64:' .env; then \
    php artisan key:generate --force; \
    fi

# Permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chmod 644 .env

EXPOSE 80
CMD ["apache2-foreground"]
