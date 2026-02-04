# ========================
# STAGE 1 – Composer
# ========================
FROM php:8.4-cli AS composer

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip unzip git curl \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install gd intl pdo_mysql bcmath zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-scripts --no-autoloader
COPY . .
RUN composer dump-autoload --optimize --classmap-authoritative

# ========================
# STAGE 2 – PHP Final
# ========================
FROM php:8.4-fpm

# Extensões necessárias
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl pdo pdo_mysql bcmath zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

# Copia app
COPY --chown=www-data:www-data . .

# Criar diretório public/build antes de copiar
RUN mkdir -p public/build

# Copia dependências
COPY --from=composer --chown=www-data:www-data /app/vendor vendor

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache public/build \
    && chmod -R 755 /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]