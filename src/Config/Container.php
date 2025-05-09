<?php
// src/Config/Container.php
namespace App\Config;

use PDO;
use App\Repositories\PDO\CandidatureRepository;
use App\Repositories\PDO\StageRepository;
use App\Repositories\PDO\EntrepriseRepository;
use App\Repositories\PDO\StatutRepository;
use App\Repositories\PDO\ContactRepository;
use App\Services\CandidatureService;
use App\Services\StageService;
use App\Services\EntrepriseService;
use App\Services\StatutService;
use App\Services\ContactService;
use App\Controllers\StageController;
use App\Controllers\EntrepriseController;
use App\Controllers\ContactController;
use App\Controllers\AccueilController;
use App\View\ViewRenderer;
use App\Controllers\DebugController;
use App\Tests\FunctionalTestRunner;

class Container
{
    private array $instances = [];

    public function get(string $id)
    {
        if (!isset($this->instances[$id])) {
            $this->instances[$id] = $this->create($id);
        }

        return $this->instances[$id];
    }

    private function create(string $id)
    {
        switch ($id) {
            case 'PDO':
                $dsn = sprintf(
                    'mysql:host=%s;dbname=%s;charset=%s',
                    CONFIG['db']['host'],
                    CONFIG['db']['name'],
                    CONFIG['db']['charset']
                );
                return new PDO(
                    $dsn,
                    CONFIG['db']['user'],
                    CONFIG['db']['pass'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );

            case CandidatureRepository::class:
                return new CandidatureRepository($this->get('PDO'));

            case StageRepository::class:
                return new StageRepository($this->get('PDO'));

            case EntrepriseRepository::class:
                return new EntrepriseRepository($this->get('PDO'));

            case StatutRepository::class:
                return new StatutRepository($this->get('PDO'));

            case ContactRepository::class:
                return new ContactRepository($this->get('PDO'));

            case CandidatureService::class:
                return new CandidatureService(
                    $this->get(CandidatureRepository::class),
                    $this->get(StageRepository::class),
                    $this->get(StatutRepository::class)
                );

            case StageService::class:
                return new StageService(
                    $this->get(StageRepository::class),
                    $this->get(EntrepriseRepository::class)
                );

            case EntrepriseService::class:
                return new EntrepriseService(
                    $this->get(EntrepriseRepository::class)
                );

            case StatutService::class:
                return new StatutService(
                    $this->get(StatutRepository::class)
                );

            case ContactService::class:
                return new ContactService(
                    $this->get(ContactRepository::class),
                    $this->get(EntrepriseRepository::class)
                );

            case ViewRenderer::class:
                return new ViewRenderer();

            case StageController::class:
                return new StageController(
                    $this->get(StageService::class),
                    $this->get(CandidatureService::class),
                    $this->get(EntrepriseService::class),
                    $this->get(StatutService::class),
                    $this->get(ViewRenderer::class)
                );

            case EntrepriseController::class:
                return new EntrepriseController(
                    $this->get(EntrepriseService::class),
                    $this->get(ContactService::class),
                    $this->get(ViewRenderer::class)
                );

            case ContactController::class:
                return new ContactController(
                    $this->get(ContactService::class),
                    $this->get(EntrepriseService::class),
                    $this->get(ViewRenderer::class)
                );

            case AccueilController::class:
                return new AccueilController(
                    $this->get(ViewRenderer::class)
                );
            
            // Debug
            case DebugController::class:
                return new DebugController(
                    $this->get(ViewRenderer::class),
                    new FunctionalTestRunner()
                );

            default:
                throw new \InvalidArgumentException("Class $id not found in container");
        }
    }
}