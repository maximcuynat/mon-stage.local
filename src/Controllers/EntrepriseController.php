<?php
// src/Controllers/EntrepriseController.php
namespace App\Controllers;

use App\Services\EntrepriseService;
use App\Services\ContactService;
use App\View\ViewRenderer;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;

class EntrepriseController
{
    private EntrepriseService $entrepriseService;
    private ContactService $contactService;
    private ViewRenderer $viewRenderer;

    public function __construct(
        EntrepriseService $entrepriseService,
        ContactService $contactService,
        ViewRenderer $viewRenderer
    ) {
        $this->entrepriseService = $entrepriseService;
        $this->contactService = $contactService;
        $this->viewRenderer = $viewRenderer;
    }

    public function index(): void
    {
        $entreprises = $this->entrepriseService->getAllEntreprises();
        $this->viewRenderer->render('Entreprises', [
            'entreprises' => $entreprises
        ]);
    }

    public function show(int $id): void
    {
        try {
            $entreprise = $this->entrepriseService->getEntrepriseById($id);
            $contacts = $this->contactService->getContactsByEntrepriseId($id);

            $this->viewRenderer->render('InfoEntreprise', [
                'entreprise' => $entreprise,
                'allContacts' => $contacts
            ]);
        } catch (NotFoundException $e) {
            $this->viewRenderer->render('Error', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }

    public function create(): void
    {
        $this->viewRenderer->render('AddEntreprise', []);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /entreprises');
            return;
        }

        $data = $_POST;

        try {
            $this->entrepriseService->createEntreprise([
                'Nom' => $data['Nom_entreprise'],
                'Adresse' => $data['Adresse'] ?? null,
                'Ville' => $data['Ville'] ?? null,
                'Code_Postal' => $data['Code_postal'] ?? null,
                'Pays' => $data['Pays'] ?? null,
                'Telephone' => $data['Telephone'] ?? null,
                'Site_Web' => $data['Site_web'] ?? null,
                'Email' => $data['Email'] ?? null
            ]);

            header('Location: /entreprises');
        } catch (ValidationException $e) {
            $this->viewRenderer->render('AddEntreprise', [
                'errors' => $e->getErrors(),
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $this->viewRenderer->render('AddEntreprise', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
        }
    }

    public function edit(int $id): void
    {
        try {
            $entreprise = $this->entrepriseService->getEntrepriseById($id);

            $this->viewRenderer->render('EditEntreprise', [
                'entreprise' => $entreprise
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
            header('Location: /entreprises');
            return;
        }

        $data = $_POST;

        try {
            $this->entrepriseService->updateEntreprise($id, [
                'Nom' => $data['Nom_entreprise'],
                'Adresse' => $data['Adresse'] ?? null,
                'Ville' => $data['Ville'] ?? null,
                'Code_Postal' => $data['Code_postal'] ?? null,
                'Pays' => $data['Pays'] ?? null,
                'Telephone' => $data['Telephone'] ?? null,
                'Site_Web' => $data['Site_web'] ?? null,
                'Email' => $data['Email'] ?? null
            ]);

            header('Location: /entreprises');
        } catch (ValidationException $e) {
            $entreprise = $this->entrepriseService->getEntrepriseById($id);

            $this->viewRenderer->render('EditEntreprise', [
                'entreprise' => $entreprise,
                'errors' => $e->getErrors(),
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $entreprise = $this->entrepriseService->getEntrepriseById($id);

            $this->viewRenderer->render('EditEntreprise', [
                'entreprise' => $entreprise,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->entrepriseService->deleteEntreprise($id);
            header('Location: /entreprises');
        } catch (\Exception $e) {
            $this->viewRenderer->render('Error', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }
}
