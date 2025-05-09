<?php
// src/Config/config.php

// Charger les configurations
$defaultConfig = require_once __DIR__ . '/config.default.php';
$localConfig = file_exists(__DIR__ . '/config.local.php') 
    ? require_once __DIR__ . '/config.local.php'
    : [];

// Fusionner les configurations (la locale écrase la défaut)
$config = array_replace_recursive($defaultConfig, $localConfig);

// Définir la constante CONFIG
define('CONFIG', $config);

// Configuration de l'affichage des erreurs
if (CONFIG['app']['environment'] === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ERROR | E_PARSE);
}