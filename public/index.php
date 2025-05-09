<?php
// public/index.php

// Inclusion de l'autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Chargement de la configuration
require_once __DIR__ . '/../src/Config/config.php';

// Inclusion du routeur
require_once __DIR__ . '/../src/Router.php';

// Création et exécution du routeur
$router = new App\Router();
$router->route();