<?php
// src/Controllers/ContactController.php
namespace App\Controllers;

use App\Services\ContactService;
use App\Services\EntrepriseService;
use App\View\ViewRenderer;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

class ContactController
{
    private ContactService $contactService;
    private EntrepriseService $entrepriseService;
    private ViewRenderer $viewRenderer;

    public function __construct(
        ContactService $contactService,
        EntrepriseService $entrepriseService,
        ViewRenderer $viewRenderer
    ) {
        $this->contactService = $contactService;
        $this->entrepriseService = $entrepriseService;
        $this->viewRenderer = $viewRenderer;
    }

    public function index(): void
    {
        $contacts = $this->contactService->getAllContacts();
        $this->viewRenderer->render('contacts.index', [
            'contacts' => $contacts
        ]);
    }

    public function show(int $id): void
    {
        try {
            $contact = $this->contactService->getContactById($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($contact->getIdEntreprise());

            $this->viewRenderer->render('contacts.info', [
                'contact' => $contact,
                'entreprise' => $entreprise
            ]);
        } catch (NotFoundException $e) {
            $this->viewRenderer->render('Error', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }

    public function create(): void
    {
        $entreprises = $this->entrepriseService->getAllEntreprises();

        $this->viewRenderer->render('contacts.add', [
            'entreprises' => $entreprises
        ]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /contacts');
            return;
        }

        $data = $_POST;

        try {
            // Vérifier si l'entreprise existe, sinon la créer
            $entrepriseId = 0;
            if (!empty($data['Nom_entreprise'])) {
                $entreprise = $this->entrepriseService->getEntrepriseByNom($data['Nom_entreprise']);

                if ($entreprise) {
                    $entrepriseId = $entreprise->getId();
                } else {
                    $entrepriseId = $this->entrepriseService->createEntreprise([
                        'Nom' => $data['Nom_entreprise']
                    ]);
                }
            }

            // Créer le contact
            $this->contactService->createContact([
                'Nom' => $data['Nom_contact'],
                'Prenom' => $data['Prenom_contact'] ?? null,
                'Email' => $data['Email_contact'] ?? null,
                'Telephone' => $data['Tel_contact'] ?? null,
                'Poste' => $data['Poste_contact'] ?? null,
                'ID_Entreprise' => $entrepriseId
            ]);

            header('Location: /contacts');
        } catch (ValidationException $e) {
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('contacts.add', [
                'entreprises' => $entreprises,
                'errors' => $e->getErrors(),
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('contacts.add', [
                'entreprises' => $entreprises,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
        }
    }

    public function edit(int $id): void
    {
        try {
            $contact = $this->contactService->getContactById($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($contact->getIdEntreprise());
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('contacts.edit', [
                'contact' => $contact,
                'entreprise' => $entreprise,
                'entreprises' => $entreprises
            ]);
        } catch (NotFoundException $e) {
            $this->viewRenderer->render('Error', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /contacts');
            return;
        }

        $data = $_POST;

        try {
            // Vérifier si l'entreprise a été modifiée
            $entrepriseId = (int) $data['idEntreprise'];
            if (!empty($data['Nom_entreprise'])) {
                $entreprise = $this->entrepriseService->getEntrepriseByNom($data['Nom_entreprise']);

                if ($entreprise) {
                    $entrepriseId = $entreprise->getId();
                } else {
                    $entrepriseId = $this->entrepriseService->createEntreprise([
                        'Nom' => $data['Nom_entreprise']
                    ]);
                }
            }

            // Mettre à jour le contact
            $this->contactService->updateContact($id, [
                'Nom' => $data['nom'],
                'Prenom' => $data['prenom'] ?? null,
                'Email' => $data['email'] ?? null,
                'Telephone' => $data['telephone'] ?? null,
                'Poste' => $data['poste'] ?? null,
                'ID_Entreprise' => $entrepriseId
            ]);

            header('Location: /contacts');
        } catch (ValidationException $e) {
            $contact = $this->contactService->getContactById($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($contact->getIdEntreprise());
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('contacts.edit', [
                'contact' => $contact,
                'entreprise' => $entreprise,
                'entreprises' => $entreprises,
                'errors' => $e->getErrors(),
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $contact = $this->contactService->getContactById($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($contact->getIdEntreprise());
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('contacts.edit', [
                'contact' => $contact,
                'entreprise' => $entreprise,
                'entreprises' => $entreprises,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->contactService->deleteContact($id);
            header('Location: /contacts');
        } catch (\Exception $e) {
            $this->viewRenderer->render('Error', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }
}