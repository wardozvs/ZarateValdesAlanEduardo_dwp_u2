# Usar una imagen oficial de PHP 8.2 con Apache
FROM php:8.2-apache

# 1. Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# 2. Habilitar mod_rewrite de Apache para las URLs de Laravel
RUN a2enmod rewrite
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# 3. Obtener la ultima versión de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Establecer el directorio de trabajo en el contenedor
WORKDIR /var/www/html

# 5. Copiar archivos de Composer e instalar dependencias
COPY composer.json composer.lock ./
COPY . .
RUN composer install --no-interaction --no-dev --optimize-autoloader

# 6. Ajustar permisos de archivos para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache