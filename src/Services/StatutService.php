<?php
// src/Services/StatutService.php
namespace App\Services;

use App\Models\Statut;
use App\Repositories\StatutRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

class StatutService
{
    private StatutRepositoryInterface $statutRepository;

    public function __construct(StatutRepositoryInterface $statutRepository)
    {
        $this->statutRepository = $statutRepository;
    }

    /**
     * @return Statut[]
     */
    public function getAllStatuts(): array
    {
        return $this->statutRepository->findAll();
    }

    public function getStatutById(int $id): ?Statut
    {
        $statut = $this->statutRepository->findById($id);
        if (!$statut) {
            throw new NotFoundException("Statut avec ID $id non trouvé");
        }
        return $statut;
    }

    public function createStatut(array $data): int
    {
        $this->validateStatutData($data);

        $statut = new Statut();
        $statut->setLibelle($data['Statut']);

        return $this->statutRepository->save($statut);
    }

    public function updateStatut(int $id, array $data): bool
    {
        $statut = $this->statutRepository->findById($id);
        if (!$statut) {
            throw new NotFoundException("Statut avec ID $id non trouvé");
        }

        $this->validateStatutData($data);

        if (isset($data['Statut'])) {
            $statut->setLibelle($data['Statut']);
        }

        return $this->statutRepository->update($statut);
    }

    public function deleteStatut(int $id): bool
    {
        if (!$this->statutRepository->findById($id)) {
            throw new NotFoundException("Statut avec ID $id non trouvé");
        }

        return $this->statutRepository->delete($id);
    }

    private function validateStatutData(array $data): void
    {
        $errors = [];

        if (isset($data['Statut']) && empty($data['Statut'])) {
            $errors[] = "Le libellé du statut est obligatoire";
        }

        if (!empty($errors)) {
            throw new ValidationException("Données du statut invalides", $errors);
        }
    }
}
