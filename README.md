# Installation du Site Web de Gestion de Candidatures de Stage

Ce guide vous aidera à installer et à configurer le site web de gestion de candidatures de stage sur votre environnement local.

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- Serveur web (par exemple, Apache)
- PHP (version 7.x recommandée)
- Système de gestion de base de données MySQL ou MariaDB
- Un navigateur web moderne

## Étapes d'Installation

1. **Installer xampp server** ! 
- [Installer XAMPP](https://www.apachefriends.org/fr/download.html)
2. **Ajouter le nom de domaine mon-stage.local**
- Aller chercher le fichier host
*WIN + r et copier coller le chemin d'accès ci dessous*
> C:\Windows\System32\drivers\etc\

- Ouvrir le fichier en tant que administrateur avec un editeur de texte et ajouter la ligne suivante.
> 127.0.0.1 mon-stage.local*

3. Cloner le site web à partir de github dans le fichier
*Nom du dossier dans lequel il faut cloner le git **mon-stage.local** *

> C:\www\mon-stage.local