<?php
// src/Router.php
namespace App;

use App\View\ViewRenderer;
use App\Config\Container;
use App\Controllers\StageController;
use App\Controllers\EntrepriseController;
use App\Controllers\ContactController;
use App\Controllers\AccueilController;
use App\Exceptions\NotFoundException;

class Router
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function route(): void
    {
        $url = $this->parseUrl();

        try {
            // Routing en fonction de l'URL
            if (empty($url[0])) {
                $controller = $this->container->get(AccueilController::class);
                $controller->index();
                return;
            }

            $routes = [
                'stages' => StageController::class,
                'entreprises' => EntrepriseController::class,
                'contacts' => ContactController::class,
                'accueil' => AccueilController::class
            ];

            if (!isset($routes[$url[0]])) {
                throw new NotFoundException("Page introuvable");
            }

            $controllerClass = $routes[$url[0]];
            $controller = $this->container->get($controllerClass);

            if ($url[0] === 'accueil' || count($url) === 1) {
                $controller->index();
                return;
            }

            $this->handleGenericRoutes($controller, $url);

        } catch (NotFoundException $e) {
            $view = $this->container->get(ViewRenderer::class);
            $view->render('Error', [
                'errorMessage' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            $view = $this->container->get(ViewRenderer::class);
            $view->render('Error', [
                'errorMessage' => "Une erreur s'est produite: " . $e->getMessage()
            ]);
        }
    }

    private function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
        }
        return [];
    }

    private function handleGenericRoutes(object $controller, array $url): void
    {
        if (count($url) >= 2) {
            switch ($url[1]) {
                case 'add':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $controller->store();
                    } else {
                        $controller->create();
                    }
                    break;

                case 'edit':
                    if (isset($url[2]) && is_numeric($url[2])) {
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $controller->update((int) $url[2]);
                        } else {
                            $controller->edit((int) $url[2]);
                        }
                    } else {
                        throw new NotFoundException("Page introuvable");
                    }
                    break;

                case 'delete':
                    if (isset($url[2]) && is_numeric($url[2])) {
                        $controller->delete((int) $url[2]);
                    } else {
                        throw new NotFoundException("Page introuvable");
                    }
                    break;

                default:
                    if (is_numeric($url[1])) {
                        $controller->show((int) $url[1]);
                    } else {
                        throw new NotFoundException("Page introuvable");
                    }
            }
        }
    }
}