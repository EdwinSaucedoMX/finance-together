FROM bitnami/laravel:12.0.8-debian-12-r1

WORKDIR /app

# Copia tu código fuente
COPY . /app

# Instala dependencias Composer (sin dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Instala Node.js y compila assets
RUN npm install && npm run build

# Crea el storage link
RUN php artisan storage:link

# Da permisos a las carpetas necesarias
RUN chown -R bitnami:daemon storage bootstrap/cache

# Expone el puerto 8000 (por defecto Bitnami Laravel)
EXPOSE 8000
