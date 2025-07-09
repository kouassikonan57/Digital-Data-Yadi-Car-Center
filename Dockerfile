# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier tous les fichiers du projet dans le dossier Apache
COPY ./ /var/www/html/

# Donner les droits nécessaires aux fichiers copiés
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Exposer le port 80 pour l'accès HTTP
EXPOSE 80