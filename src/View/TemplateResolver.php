<?php
// src/View/TemplateResolver.php
namespace App\View;

class TemplateResolver
{
    private string $basePath;
    
    public function __construct(string $basePath = null)
    {
        $this->basePath = $basePath ?? __DIR__ . '/../../templates';
    }
    
    public function resolve(string $view): string
    {
        // Convertit "controller.action" en "controller/action.php"
        $path = str_replace('.', '/', $view) . '.php';
        $fullPath = $this->basePath . '/' . $path;
        
        if (!file_exists($fullPath)) {
            throw new \Exception("Template not found: {$fullPath}");
        }
        
        return $fullPath;
    }
}