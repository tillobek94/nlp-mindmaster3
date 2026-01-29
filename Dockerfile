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
    libjpeg62-turbo-dev \
    sqlite3 \
    libsqlite3-dev

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache config
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY . .

# Create Laravel directories
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && mkdir -p database

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache

# Create log file
RUN touch storage/logs/laravel.log \
    && chown www-data:www-data storage/logs/laravel.log \
    && chmod 666 storage/logs/laravel.log

# Create SQLite database
RUN touch database/database.sqlite \
    && chown www-data:www-data database/database.sqlite \
    && chmod 666 database/database.sqlite

# Setup .env
RUN if [ ! -f .env ]; then \
    if [ -f .env.example ]; then \
        cp .env.example .env; \
    else \
        echo "APP_NAME=Laravel\nAPP_ENV=production\nAPP_KEY=\nAPP_DEBUG=false\nAPP_URL=https://nlp-mindmaster3.onrender.com\nDB_CONNECTION=sqlite\nDB_DATABASE=/var/www/html/database/database.sqlite" > .env; \
    fi; \
    fi

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key if not set
RUN if ! grep -q 'APP_KEY=base64:' .env; then \
    php artisan key:generate --force; \
    fi

# Cache config
RUN php artisan config:cache

EXPOSE 80
CMD ["apache2-foreground"]
