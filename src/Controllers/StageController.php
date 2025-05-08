<?php
// src/Controllers/StageController.php
namespace App\Controllers;

use App\Services\StageService;
use App\Services\CandidatureService;
use App\Services\EntrepriseService;
use App\Services\StatutService;
use App\View\ViewRenderer;
use App\Exceptions\NotFoundException;

class StageController
{
    private StageService $stageService;
    private CandidatureService $candidatureService;
    private EntrepriseService $entrepriseService;
    private StatutService $statutService;
    private ViewRenderer $viewRenderer;

    public function __construct(
        StageService $stageService,
        CandidatureService $candidatureService,
        EntrepriseService $entrepriseService,
        StatutService $statutService,
        ViewRenderer $viewRenderer
    ) {
        $this->stageService = $stageService;
        $this->candidatureService = $candidatureService;
        $this->entrepriseService = $entrepriseService;
        $this->statutService = $statutService;
        $this->viewRenderer = $viewRenderer;
    }

    public function index(): void
    {
        $stages = $this->stageService->getAllStages();
        $this->viewRenderer->render('Stages', [
            'stages' => $stages
        ]);
    }

    public function show(int $id): void
    {
        try {
            $stage = $this->stageService->getStageById($id);
            if (!$stage) {
                throw new NotFoundException("Stage introuvable");
            }

            $candidature = $this->candidatureService->getCandidatureByStageId($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($stage->getIdEntreprise());

            $this->viewRenderer->render('InfoStage', [
                'stage' => $stage,
                'candidature' => $candidature,
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
        $statuts = $this->statutService->getAllStatuts();

        $this->viewRenderer->render('AddStage', [
            'entreprises' => $entreprises,
            'statuts' => $statuts
        ]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /stages');
            return;
        }

        $data = $_POST;
        $errors = $this->validateStageData($data);

        if (!empty($errors)) {
            $entreprises = $this->entrepriseService->getAllEntreprises();
            $statuts = $this->statutService->getAllStatuts();

            $this->viewRenderer->render('AddStage', [
                'entreprises' => $entreprises,
                'statuts' => $statuts,
                'errors' => $errors,
                'data' => $data
            ]);
            return;
        }

        try {
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

            $stageId = $this->stageService->createStage([
                'ID_Entreprise' => $entrepriseId,
                'Lien_Offre' => $data['Lien_offre'],
                'Description' => $data['Description'],
                'Date_Postulation' => $data['Date_postulation']
            ]);

            $this->candidatureService->createCandidature([
                'ID_Stage' => $stageId,
                'ID_Statut' => $data['status'],
                'Date_Candidature' => $data['Date_postulation'],
                'Commentaires' => $data['Commentaires'] ?? null
            ]);

            header('Location: /stages');
        } catch (\Exception $e) {
            $entreprises = $this->entrepriseService->getAllEntreprises();
            $statuts = $this->statutService->getAllStatuts();

            $this->viewRenderer->render('AddStage', [
                'entreprises' => $entreprises,
                'statuts' => $statuts,
                'error' => $e->getMessage(),
                'data' => $data
            ]);
        }
    }

    public function edit(int $id): void
    {
        try {
            $stage = $this->stageService->getStageById($id);
            if (!$stage) {
                throw new NotFoundException("Stage introuvable");
            }

            $candidature = $this->candidatureService->getCandidatureByStageId($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($stage->getIdEntreprise());
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('EditStage', [
                'stage' => $stage,
                'candidature' => $candidature,
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
            header('Location: /stages');
            return;
        }

        $data = $_POST;
        $errors = $this->validateStageData($data);

        if (!empty($errors)) {
            $stage = $this->stageService->getStageById($id);
            $candidature = $this->candidatureService->getCandidatureByStageId($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($stage->getIdEntreprise());
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('EditStage', [
                'stage' => $stage,
                'candidature' => $candidature,
                'entreprise' => $entreprise,
                'entreprises' => $entreprises,
                'errors' => $errors,
                'data' => $data
            ]);
            return;
        }

        try {
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

            $this->stageService->updateStage($id, [
                'ID_Entreprise' => $entrepriseId,
                'Lien_Offre' => $data['Lien_offre'],
                'Description' => $data['Description'],
                'Date_Postulation' => $data['Date_postulation']
            ]);

            $candidature = $this->candidatureService->getCandidatureByStageId($id);
            if ($candidature) {
                $this->candidatureService->updateCandidature($candidature->getId(), [
                    'ID_Statut' => $data['status'],
                    'Date_Candidature' => $data['Date_postulation'],
                    'Commentaires' => $data['Commentaires'] ?? null
                ]);
            }

            header('Location: /stages');
        } catch (\Exception $e) {
            $stage = $this->stageService->getStageById($id);
            $candidature = $this->candidatureService->getCandidatureByStageId($id);
            $entreprise = $this->entrepriseService->getEntrepriseById($stage->getIdEntreprise());
            $entreprises = $this->entrepriseService->getAllEntreprises();

            $this->viewRenderer->render('EditStage', [
                'stage' => $stage,
                'candidature' => $candidature,
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
            $this->candidatureService->deleteCandidatureByStageId($id);
            $this->stageService->deleteStage($id);

            header('Location: /stages');
        } catch (\Exception $e) {
            $this->viewRenderer->render('Error', [
                'errorMessage' => $e->getMessage()
            ]);
        }
    }

    private function validateStageData(array $data): array
    {
        $errors = [];

        if (empty($data['Nom_entreprise'])) {
            $errors[] = "Le nom de l'entreprise est obligatoire";
        }

        if (empty($data['Lien_offre'])) {
            $errors[] = "Le lien de l'offre est obligatoire";
        }

        if (empty($data['Description'])) {
            $errors[] = "La description est obligatoire";
        }

        if (empty($data['status'])) {
            $errors[] = "Le statut est obligatoire";
        }

        if (empty($data['Date_postulation'])) {
            $errors[] = "La date de postulation est obligatoire";
        }

        return $errors;
    }
}