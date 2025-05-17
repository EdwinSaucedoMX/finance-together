#!/bin/bash
# Script para iniciar el servidor de Laravel y evitar timeout en "composer run dev"

echo "Iniciando servidor de desarrollo de Laravel..."

php artisan db:seed

# Iniciar el servidor de Laravel en segundo plano
php artisan serve &

# Iniciar Vite para la compilación de assets
echo "Iniciando Vite..."
npx vite