# Etapa 1: Instalar dependencias con Composer
FROM composer:2 as vendor

WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Etapa 2: Imagen final de producción con PHP y Nginx
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

# Instalar Nginx y Supervisor
RUN apk add --no-cache nginx supervisor

# Instalar dependencias del sistema y extensiones de PHP
RUN apk add --no-cache \
        libpng-dev \
        jpeg-dev \
        freetype-dev \
        libzip-dev \
        unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql exif pcntl

# Copiar archivos de configuración de Nginx y Supervisor
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf

# Copiar los archivos de la aplicación y las dependencias ya instaladas
COPY . .
COPY --from=vendor /app/vendor/ ./vendor/

# 1. Establecer permisos amplios ANTES de ejecutar Artisan para evitar fallos de escritura.
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 2. Crear el archivo de log para asegurar que Laravel pueda escribir en él.
RUN touch /var/www/html/storage/logs/laravel.log

# 3. Generar los archivos de caché de Laravel para producción.
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# 4. Re-establecer los permisos una última vez para asegurar que todo es correcto.
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# --- AÑADIR SCRIPT DE ARRANQUE ---
# Copiar el script de entrada y hacerlo ejecutable.
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Exponer el puerto 80
EXPOSE 80

# Usar el script de entrada para iniciar el servidor.
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]