<?php
// src/View/ViewRenderer.php
namespace App\View;

class ViewRenderer
{
    public function render(string $viewName, array $data = [], string $layout = 'layout'): void
    {
        // Extraire les données pour les rendre disponibles dans la vue
        extract($data);

        // Démarrer la mise en mémoire tampon
        ob_start();

        // Inclure la vue
        require_once __DIR__ . "/../../templates/{$viewName}.php";

        // Récupérer le contenu de la vue
        $content = ob_get_clean();

        // Inclure le layout avec le contenu
        require_once __DIR__ . "/../../templates/{$layout}.php";
    }
}
