# Installation du Site Web de Gestion de Candidatures de Stage

Ce guide vous aidera à installer et à configurer le site web de gestion de candidatures de stage sur votre environnement local.

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- Serveur web (par exemple, Apache)
- PHP (version 7.x recommandée)
- Système de gestion de base de données MySQL ou MariaDB
- Un navigateur web moderne

## Étapes d'Installation

1. Installer git GUI

1. **Installer xampp server** ! 
    - [Installer XAMPP](https://www.apachefriends.org/fr/download.html)

2. **Ajouter le nom de domaine mon-stage.local**
    - Aller chercher le fichier host
    *WIN + r et copier coller le chemin d'accès ci dessous*
        > C:\Windows\System32\drivers\etc\

    - Ouvrir le fichier en tant que administrateur avec un editeur de texte et ajouter la ligne suivante.
        > 127.0.0.1 mon-stage.local

3. **Cloner le site web à partir de github dans le fichier**
    > C:\www\

4. **Configurer XAMPP Serveur**

- Aller dans le dossier suivant
    >C:\xampp\apache\conf\extra\
- Ouvrir le fichier *httpd-vhosts.conf*
    ```
    <VirtualHost 127.0.0.1:80>
        DocumentRoot "C:/www/mon-stage.local"
        ServerName mon-stage.local
        ErrorLog "logs/mon-stage.local-error.log"
        CustomLog "logs/mon-stage.local-access.log" common
        <Directory "C:/www/mon-stage.local">
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
    ```

5. **La base de donnée**
- Aller à l'adresse suivante
    [PHP My Admin SQL](http://localhost/phpmyadmin/index.php?route=/server/databases)

- Créer la base de donner
    Donner le nom suivant
    > internships
    
- Executer le code au liens suivant
    [SQL Internships BDD](http://localhost/phpmyadmin/index.php?route=/database/sql&db=internships)

6. **Ouvrir le site web**
    [Mon Stage](http://mon-stage.local/accueil)

## Me faire un don

[Graysander Donation](https://www.paypal.com/paypalme/graysanderdonation)
