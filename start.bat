@echo off
:: Script para iniciar el servidor de Laravel y evitar timeout en "composer run dev"

:: Agregar las semillas a la base de datos
php artisan db:seed

echo Iniciando servidor de desarrollo de Laravel...

:: Iniciar el servidor de Laravel
start /B php artisan serve

:: Iniciar Vite para la compilación de assets
echo Iniciando Vite...
npx vite

pause