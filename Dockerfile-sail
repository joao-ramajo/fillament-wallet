FROM php:8.4-cli

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libicu-dev \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd intl

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Copiar e instalar dependências PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Instalar Node + npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Copiar e instalar dependências JS + build
COPY package.json package-lock.json ./
RUN npm install && npm run build

# Copiar o restante do projeto


# Permissões
RUN chmod -R 775 storage bootstrap/cache

# Porta usada pelo Railway
ENV PORT=8000

RUN php artisan config:clear
RUN php artisan view:clear
RUN php artisan route:clear

# Rodar Laravel
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT}"]
