<?php
// src/Config/config.php

// Configuration de base
const CONFIG = [
    'db' => [
        'host' => 'db',  // Nom du service dans docker-compose.yml
        'name' => 'internships',
        'user' => 'root',
        'pass' => 'rootpassword',
        'charset' => 'utf8'
    ],
    'app' => [
        'name' => 'Gestion des Stages',
        'version' => '2.0.0',
        'environment' => 'development' // 'production' en production
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