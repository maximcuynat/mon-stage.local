# Utiliser une image officielle de PHP avec Apache
FROM php:8.0-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql

# Activer le module de réécriture d'Apache
RUN a2enmod rewrite

# Configure Apache pour utiliser le répertoire public comme DocumentRoot
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Créer les répertoires nécessaires
RUN mkdir -p /var/www/html/public /var/www/html/templates /var/www/html/assets

# Copier les fichiers du site dans le répertoire Apache
COPY . /var/www/html/

# Installer composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installation des dépendances
WORKDIR /var/www/html
RUN composer install --no-interaction

# Assurer que les fichiers appartiennent à l'utilisateur www-data
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80