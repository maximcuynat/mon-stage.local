<?php
// public/index.php

// Définition du chemin de base
define('ROOT', dirname(__DIR__));

// Autoloader de Composer
require_once ROOT . '/vendor/autoload.php';

// Configuration
require_once ROOT . '/src/Config/config.php';

// Router
$router = new App\Router();
$router->route();