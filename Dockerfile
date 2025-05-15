# Gunakan image PHP resmi dengan Apache
FROM php:8.2-apache

# Salin semua file dari repo ke direktori web Apache
COPY . /var/www/html/

# (Opsional) Set permission
RUN chown -R www-data:www-data /var/www/html
