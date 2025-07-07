# Utiliser une image officielle PHP avec le serveur Apache
FROM php:8.3-apache

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copier tous les fichiers du projet (votre code PHP, le fichier JSON, etc.)
# dans le répertoire de travail du conteneur.
COPY . .

# Donner au serveur web (Apache) les permissions d'écrire sur les fichiers.
# C'est crucial pour que votre script PHP puisse modifier le fichier JSON.
RUN chown -R www-data:www-data /var/www/html

# Le port 80 est exposé par défaut par l'image Apache,
# mais c'est une bonne pratique de le documenter.
EXPOSE 80
