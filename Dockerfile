# Base image s PHP 8.2 a Composerem
FROM laravelsail/php82-composer:latest

# Nastav pracovní složku
WORKDIR /var/www/html

# Zkopíruj celý projekt do image
COPY . .

# Nastav environment proměnné pro Composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Nainstaluj PHP extensions potřebné pro Laravel a nástroje git a curl
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libwebp-dev \
        libxpm-dev \
        libxml2-dev \
        libonig-dev \
        unzip \
        git \
        curl \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd tokenizer xml

# Composer install
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Expose port
EXPOSE 8000

# Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
