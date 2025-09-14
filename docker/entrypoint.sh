#!/bin/sh

# Forzar la corrección de permisos en las carpetas de Laravel cada vez que el contenedor se inicie.
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Ejecutar el comando principal para iniciar el servidor (Nginx y PHP-FPM).
exec /usr/bin/supervisord -c /etc/supervisord.conf