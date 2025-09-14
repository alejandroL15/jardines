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

# --- CORRECCIÓN FINAL AQUÍ ---
# Generar los archivos de caché de Laravel para producción
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Establecer permisos correctos para Laravel (muy importante que vaya DESPUÉS de los comandos artisan)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Nginx y PHP-FPM con Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]