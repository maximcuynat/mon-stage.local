<?php
// src/Services/CandidatureService.php
namespace App\Services;

use App\Models\Candidature;
use App\Repositories\CandidatureRepositoryInterface;
use App\Repositories\StageRepositoryInterface;
use App\Repositories\StatutRepositoryInterface;

class CandidatureService
{
    private CandidatureRepositoryInterface $candidatureRepository;
    private StageRepositoryInterface $stageRepository;
    private StatutRepositoryInterface $statutRepository;

    public function __construct(
        CandidatureRepositoryInterface $candidatureRepository,
        StageRepositoryInterface $stageRepository,
        StatutRepositoryInterface $statutRepository
    ) {
        $this->candidatureRepository = $candidatureRepository;
        $this->stageRepository = $stageRepository;
        $this->statutRepository = $statutRepository;
    }

    public function getAllCandidatures(): array
    {
        return $this->candidatureRepository->findAll();
    }

    public function getCandidatureById(int $id): ?Candidature
    {
        return $this->candidatureRepository->findById($id);
    }

    public function getCandidatureByStageId(int $stageId): ?Candidature
    {
        return $this->candidatureRepository->findByStageId($stageId);
    }

    public function createCandidature(array $data): int
    {
        // Vérifications métier
        if (!isset($data['ID_Stage']) || !$this->stageRepository->findById((int) $data['ID_Stage'])) {
            throw new \InvalidArgumentException("Le stage associé n'existe pas");
        }

        if (!isset($data['ID_Statut']) || !$this->statutRepository->findById((int) $data['ID_Statut'])) {
            throw new \InvalidArgumentException("Le statut spécifié n'existe pas");
        }

        // Création de l'objet Candidature
        $candidature = new Candidature();
        $candidature->setStageId((int) $data['ID_Stage'])
            ->setStatutId((int) $data['ID_Statut'])
            ->setDateCandidature($data['Date_Candidature'] ?? date('Y-m-d'))
            ->setCommentaires($data['Commentaires'] ?? null);

        // Sauvegarde et retour de l'ID
        return $this->candidatureRepository->save($candidature);
    }

    public function updateCandidature(int $id, array $data): bool
    {
        // Récupération de la candidature existante
        $candidature = $this->candidatureRepository->findById($id);
        if (!$candidature) {
            throw new \InvalidArgumentException("La candidature avec l'ID $id n'existe pas");
        }

        // Mise à jour des champs
        if (isset($data['ID_Stage'])) {
            if (!$this->stageRepository->findById((int) $data['ID_Stage'])) {
                throw new \InvalidArgumentException("Le stage associé n'existe pas");
            }
            $candidature->setStageId((int) $data['ID_Stage']);
        }

        if (isset($data['ID_Statut'])) {
            if (!$this->statutRepository->findById((int) $data['ID_Statut'])) {
                throw new \InvalidArgumentException("Le statut spécifié n'existe pas");
            }
            $candidature->setStatutId((int) $data['ID_Statut']);
        }

        if (isset($data['Date_Candidature'])) {
            $candidature->setDateCandidature($data['Date_Candidature']);
        }

        if (array_key_exists('Commentaires', $data)) {
            $candidature->setCommentaires($data['Commentaires']);
        }

        // Sauvegarde et retour du résultat
        return $this->candidatureRepository->update($candidature);
    }

    public function deleteCandidature(int $id): bool
    {
        return $this->candidatureRepository->delete($id);
    }

    public function deleteCandidatureByStageId(int $stageId): bool
    {
        return $this->candidatureRepository->deleteByStageId($stageId);
    }
}
