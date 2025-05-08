<?php
// src/Services/StageService.php
namespace App\Services;

use App\Models\Stage;
use App\Repositories\StageRepositoryInterface;
use App\Repositories\EntrepriseRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

class StageService
{
    private StageRepositoryInterface $stageRepository;
    private EntrepriseRepositoryInterface $entrepriseRepository;

    public function __construct(
        StageRepositoryInterface $stageRepository,
        EntrepriseRepositoryInterface $entrepriseRepository
    ) {
        $this->stageRepository = $stageRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    /**
     * @return Stage[]
     */
    public function getAllStages(): array
    {
        return $this->stageRepository->findAll();
    }

    public function getStageById(int $id): ?Stage
    {
        $stage = $this->stageRepository->findById($id);
        if (!$stage) {
            throw new NotFoundException("Stage avec ID $id non trouvé");
        }
        return $stage;
    }

    /**
     * @return Stage[]
     */
    public function getStagesByEntrepriseId(int $entrepriseId): array
    {
        // Vérifier si l'entreprise existe
        if (!$this->entrepriseRepository->findById($entrepriseId)) {
            throw new NotFoundException("Entreprise avec ID $entrepriseId non trouvée");
        }

        return $this->stageRepository->findByEntrepriseId($entrepriseId);
    }

    public function createStage(array $data): int
    {
        $this->validateStageData($data);

        // Vérifier si l'entreprise existe
        if (!$this->entrepriseRepository->findById((int) $data['ID_Entreprise'])) {
            throw new NotFoundException("Entreprise avec ID {$data['ID_Entreprise']} non trouvée");
        }

        $stage = new Stage();
        $stage->setLienOffre($data['Lien_Offre'])
            ->setDescription($data['Description'])
            ->setDatePostulation($data['Date_Postulation'])
            ->setIdEntreprise((int) $data['ID_Entreprise']);

        return $this->stageRepository->save($stage);
    }

    public function updateStage(int $id, array $data): bool
    {
        $stage = $this->stageRepository->findById($id);
        if (!$stage) {
            throw new NotFoundException("Stage avec ID $id non trouvé");
        }

        $this->validateStageData($data);

        // Vérifier si l'entreprise existe
        if (isset($data['ID_Entreprise']) && !$this->entrepriseRepository->findById((int) $data['ID_Entreprise'])) {
            throw new NotFoundException("Entreprise avec ID {$data['ID_Entreprise']} non trouvée");
        }

        // Mise à jour des propriétés
        if (isset($data['Lien_Offre'])) {
            $stage->setLienOffre($data['Lien_Offre']);
        }

        if (isset($data['Description'])) {
            $stage->setDescription($data['Description']);
        }

        if (isset($data['Date_Postulation'])) {
            $stage->setDatePostulation($data['Date_Postulation']);
        }

        if (isset($data['ID_Entreprise'])) {
            $stage->setIdEntreprise((int) $data['ID_Entreprise']);
        }

        return $this->stageRepository->update($stage);
    }

    public function deleteStage(int $id): bool
    {
        if (!$this->stageRepository->findById($id)) {
            throw new NotFoundException("Stage avec ID $id non trouvé");
        }

        return $this->stageRepository->delete($id);
    }

    private function validateStageData(array $data): void
    {
        $errors = [];

        if (isset($data['Lien_Offre']) && empty($data['Lien_Offre'])) {
            $errors[] = "Le lien de l'offre est obligatoire";
        }

        if (isset($data['Description']) && empty($data['Description'])) {
            $errors[] = "La description est obligatoire";
        }

        if (isset($data['Date_Postulation']) && empty($data['Date_Postulation'])) {
            $errors[] = "La date de postulation est obligatoire";
        } elseif (isset($data['Date_Postulation'])) {
            // Vérifier le format de date
            $date = \DateTime::createFromFormat('Y-m-d', $data['Date_Postulation']);
            if (!$date || $date->format('Y-m-d') !== $data['Date_Postulation']) {
                $errors[] = "Le format de date n'est pas valide (YYYY-MM-DD)";
            }
        }

        if (isset($data['ID_Entreprise']) && empty($data['ID_Entreprise'])) {
            $errors[] = "L'ID de l'entreprise est obligatoire";
        }

        if (!empty($errors)) {
            throw new ValidationException("Données du stage invalides", $errors);
        }
    }
}
