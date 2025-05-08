<?php
// src/Controllers/AccueilController.php
namespace App\Controllers;

use App\View\ViewRenderer;

class AccueilController
{
    private ViewRenderer $viewRenderer;

    public function __construct(ViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    public function index(): void
    {
        $this->viewRenderer->render('Accueil', []);
    }
}
