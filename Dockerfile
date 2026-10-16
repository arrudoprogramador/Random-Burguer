# =====================================================
# Stage 1 — Dependências Node (build do frontend)
# =====================================================
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# =====================================================
# Stage 2 — Aplicação PHP
# =====================================================
FROM php:8.3-fpm-alpine AS app

# Instala dependências do sistema
RUN apk add --no-cache \
    bash \
    curl \
    zip \
    unzip \
    git \
    nginx \
    supervisor \
    mysql-client \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev

# Instala extensões PHP necessárias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia arquivos do projeto
COPY . .

# Copia o build do frontend
COPY --from=frontend /app/public/build ./public/build

# Instala dependências PHP (sem dev)
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist

# Cria pastas essenciais de storage e ajusta permissões
RUN mkdir -p /var/www/html/storage/framework/sessions \
             /var/www/html/storage/framework/views \
             /var/www/html/storage/framework/cache/data \
             /var/www/html/storage/logs \
             /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache

# Copia configurações e entrypoint
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php.ini $PHP_INI_DIR/conf.d/custom.ini
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8000 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]