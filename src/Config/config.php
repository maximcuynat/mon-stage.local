<?php
// src/Config/config.php

// Chargement des variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Vérification des variables requises
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'APP_ENV']);

// Configuration de base
const CONFIG = [
    'db' => [
        'host' => $_ENV['DB_HOST'],  
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
        'charset' => $_ENV['DB_CHARSET'] ?? 'utf8'
    ],
    'app' => [
        'name' => $_ENV['APP_NAME'] ?? 'Gestion des Stages',
        'version' => $_ENV['APP_VERSION'] ?? '2.0.0',
        'environment' => $_ENV['APP_ENV']
    ]
];

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