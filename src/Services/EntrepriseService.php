<?php
// src/Services/EntrepriseService.php
namespace App\Services;

use App\Models\Entreprise;
use App\Repositories\EntrepriseRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

class EntrepriseService
{
    private EntrepriseRepositoryInterface $entrepriseRepository;

    public function __construct(EntrepriseRepositoryInterface $entrepriseRepository)
    {
        $this->entrepriseRepository = $entrepriseRepository;
    }

    /**
     * @return Entreprise[]
     */
    public function getAllEntreprises(): array
    {
        return $this->entrepriseRepository->findAll();
    }

    public function getEntrepriseById(int $id): ?Entreprise
    {
        $entreprise = $this->entrepriseRepository->findById($id);
        if (!$entreprise) {
            throw new NotFoundException("Entreprise avec ID $id non trouvée");
        }
        return $entreprise;
    }

    public function getEntrepriseByNom(string $nom): ?Entreprise
    {
        return $this->entrepriseRepository->findByNom($nom);
    }

    public function createEntreprise(array $data): int
    {
        $this->validateEntrepriseData($data);

        $entreprise = new Entreprise();
        $entreprise->setNom($data['Nom'])
            ->setAdresse($data['Adresse'] ?? null)
            ->setVille($data['Ville'] ?? null)
            ->setCodePostal($data['Code_Postal'] ?? null)
            ->setPays($data['Pays'] ?? null)
            ->setTelephone($data['Telephone'] ?? null)
            ->setSiteWeb($data['Site_Web'] ?? null)
            ->setEmail($data['Email'] ?? null)
            ->setLiensOffre($data['Liens_Offre'] ?? null);

        return $this->entrepriseRepository->save($entreprise);
    }

    public function updateEntreprise(int $id, array $data): bool
    {
        $entreprise = $this->entrepriseRepository->findById($id);
        if (!$entreprise) {
            throw new NotFoundException("Entreprise avec ID $id non trouvée");
        }

        $this->validateEntrepriseData($data);

        // Mise à jour des propriétés
        if (isset($data['Nom'])) {
            $entreprise->setNom($data['Nom']);
        }

        if (array_key_exists('Adresse', $data)) {
            $entreprise->setAdresse($data['Adresse']);
        }

        if (array_key_exists('Ville', $data)) {
            $entreprise->setVille($data['Ville']);
        }

        if (array_key_exists('Code_Postal', $data)) {
            $entreprise->setCodePostal($data['Code_Postal']);
        }

        if (array_key_exists('Pays', $data)) {
            $entreprise->setPays($data['Pays']);
        }

        if (array_key_exists('Telephone', $data)) {
            $entreprise->setTelephone($data['Telephone']);
        }

        if (array_key_exists('Site_Web', $data)) {
            $entreprise->setSiteWeb($data['Site_Web']);
        }

        if (array_key_exists('Email', $data)) {
            $entreprise->setEmail($data['Email']);
        }

        if (array_key_exists('Liens_Offre', $data)) {
            $entreprise->setLiensOffre($data['Liens_Offre']);
        }

        return $this->entrepriseRepository->update($entreprise);
    }

    public function deleteEntreprise(int $id): bool
    {
        if (!$this->entrepriseRepository->findById($id)) {
            throw new NotFoundException("Entreprise avec ID $id non trouvée");
        }

        return $this->entrepriseRepository->delete($id);
    }

    private function validateEntrepriseData(array $data): void
    {
        $errors = [];

        if (isset($data['Nom']) && empty($data['Nom'])) {
            $errors[] = "Le nom de l'entreprise est obligatoire";
        }

        // Email validation
        if (isset($data['Email']) && !empty($data['Email']) && !filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Le format de l'email n'est pas valide";
        }

        // Site web validation
        if (isset($data['Site_Web']) && !empty($data['Site_Web']) && !filter_var($data['Site_Web'], FILTER_VALIDATE_URL)) {
            $errors[] = "Le format du site web n'est pas valide";
        }

        if (!empty($errors)) {
            throw new ValidationException("Données de l'entreprise invalides", $errors);
        }
    }
}
