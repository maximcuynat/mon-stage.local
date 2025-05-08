<?php
// src/Services/ContactService.php
namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepositoryInterface;
use App\Repositories\EntrepriseRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

class ContactService
{
    private ContactRepositoryInterface $contactRepository;
    private EntrepriseRepositoryInterface $entrepriseRepository;

    public function __construct(
        ContactRepositoryInterface $contactRepository,
        EntrepriseRepositoryInterface $entrepriseRepository
    ) {
        $this->contactRepository = $contactRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    /**
     * @return Contact[]
     */
    public function getAllContacts(): array
    {
        return $this->contactRepository->findAll();
    }

    public function getContactById(int $id): ?Contact
    {
        $contact = $this->contactRepository->findById($id);
        if (!$contact) {
            throw new NotFoundException("Contact avec ID $id non trouvé");
        }
        return $contact;
    }

    /**
     * @return Contact[]
     */
    public function getContactsByEntrepriseId(int $entrepriseId): array
    {
        // Vérifier si l'entreprise existe
        if (!$this->entrepriseRepository->findById($entrepriseId)) {
            throw new NotFoundException("Entreprise avec ID $entrepriseId non trouvée");
        }

        return $this->contactRepository->findByEntrepriseId($entrepriseId);
    }

    public function createContact(array $data): int
    {
        $this->validateContactData($data);

        // Vérifier si l'entreprise existe
        if (!$this->entrepriseRepository->findById((int) $data['ID_Entreprise'])) {
            throw new NotFoundException("Entreprise avec ID {$data['ID_Entreprise']} non trouvée");
        }

        $contact = new Contact();
        $contact->setNom($data['Nom'])
            ->setPrenom($data['Prenom'] ?? null)
            ->setEmail($data['Email'] ?? null)
            ->setTelephone($data['Telephone'] ?? null)
            ->setPoste($data['Poste'] ?? null)
            ->setIdEntreprise((int) $data['ID_Entreprise']);

        return $this->contactRepository->save($contact);
    }

    public function updateContact(int $id, array $data): bool
    {
        $contact = $this->contactRepository->findById($id);
        if (!$contact) {
            throw new NotFoundException("Contact avec ID $id non trouvé");
        }

        $this->validateContactData($data);

        // Vérifier si l'entreprise existe
        if (isset($data['ID_Entreprise']) && !$this->entrepriseRepository->findById((int) $data['ID_Entreprise'])) {
            throw new NotFoundException("Entreprise avec ID {$data['ID_Entreprise']} non trouvée");
        }

        // Mise à jour des propriétés
        if (isset($data['Nom'])) {
            $contact->setNom($data['Nom']);
        }

        if (array_key_exists('Prenom', $data)) {
            $contact->setPrenom($data['Prenom']);
        }

        if (array_key_exists('Email', $data)) {
            $contact->setEmail($data['Email']);
        }

        if (array_key_exists('Telephone', $data)) {
            $contact->setTelephone($data['Telephone']);
        }

        if (array_key_exists('Poste', $data)) {
            $contact->setPoste($data['Poste']);
        }

        if (isset($data['ID_Entreprise'])) {
            $contact->setIdEntreprise((int) $data['ID_Entreprise']);
        }

        return $this->contactRepository->update($contact);
    }

    public function deleteContact(int $id): bool
    {
        if (!$this->contactRepository->findById($id)) {
            throw new NotFoundException("Contact avec ID $id non trouvé");
        }

        return $this->contactRepository->delete($id);
    }

    private function validateContactData(array $data): void
    {
        $errors = [];

        if (isset($data['Nom']) && empty($data['Nom'])) {
            $errors[] = "Le nom du contact est obligatoire";
        }

        // Email validation
        if (isset($data['Email']) && !empty($data['Email']) && !filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Le format de l'email n'est pas valide";
        }

        if (isset($data['ID_Entreprise']) && empty($data['ID_Entreprise'])) {
            $errors[] = "L'ID de l'entreprise est obligatoire";
        }

        if (!empty($errors)) {
            throw new ValidationException("Données du contact invalides", $errors);
        }
    }
}
