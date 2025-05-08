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

            switch ($url[0]) {
                case 'stages':
                    $controller = $this->container->get(StageController::class);
                    $this->handleStageRoutes($controller, $url);
                    break;

                case 'entreprises':
                    $controller = $this->container->get(EntrepriseController::class);
                    $this->handleEntrepriseRoutes($controller, $url);
                    break;

                case 'contacts':
                    $controller = $this->container->get(ContactController::class);
                    $this->handleContactRoutes($controller, $url);
                    break;

                case 'accueil':
                    $controller = $this->container->get(AccueilController::class);
                    $controller->index();
                    break;

                default:
                    throw new NotFoundException("Page introuvable");
            }
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

    private function handleStageRoutes(StageController $controller, array $url): void
    {
        if (count($url) === 1) {
            $controller->index();
            return;
        }

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

    private function handleEntrepriseRoutes(EntrepriseController $controller, array $url): void
    {
        if (count($url) === 1) {
            $controller->index();
            return;
        }

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

    private function handleContactRoutes(ContactController $controller, array $url): void
    {
        if (count($url) === 1) {
            $controller->index();
            return;
        }

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
