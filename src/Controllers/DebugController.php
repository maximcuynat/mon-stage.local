<?php
namespace App\Controllers;

use App\Tests\FunctionalTestRunner;
use App\View\ViewRenderer;

class DebugController
{
    private ViewRenderer $viewRenderer;
    private FunctionalTestRunner $testRunner;

    public function __construct(ViewRenderer $viewRenderer, FunctionalTestRunner $testRunner = null)
    {
        $this->viewRenderer = $viewRenderer;
        $this->testRunner = $testRunner ?? new FunctionalTestRunner();
    }

    public function index(): void
    {
        // Vérifier si nous sommes dans l'environnement test
        if (CONFIG['app']['environment'] !== 'test') {
            header('Location: /');
            exit;
        }

        $results = $this->testRunner->runAllTests();
        
        $this->viewRenderer->render('debug.index', [
            'results' => $results,
            'summary' => $this->testRunner->getSummary()
        ]);
    }
}