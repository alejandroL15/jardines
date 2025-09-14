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

# --- CORRECCIÓN AQUÍ ---
# Primero, instalar las dependencias del sistema necesarias para las extensiones de PHP
# Luego, configurar y compilar las extensiones de PHP
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

# Establecer permisos correctos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Nginx y PHP-FPM con Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
```

### Próximos Pasos

1.  **Reemplaza el código:** Copia el código de arriba y pégalo en tu archivo `Dockerfile` local, reemplazando todo lo que había antes.
2.  **Actualiza GitHub:** Guarda el archivo y sube los cambios a tu repositorio.
    ```bash
    git add Dockerfile
    git commit -m "Añadir dependencias del sistema para extensiones de PHP"
    git push
    

