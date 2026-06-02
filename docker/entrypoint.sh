#!/bin/bash
set -e

echo "Iniciando RandomBurguer..."

# Aguarda o banco ficar disponível
until php artisan migrate --force 2>/dev/null; do
    echo "Aguardando banco de dados..."
    sleep 3
done

echo "Migrations executadas."

# Otimizações Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Cache gerado."

# Permissões
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "Aplicação pronta!"

exec "$@"