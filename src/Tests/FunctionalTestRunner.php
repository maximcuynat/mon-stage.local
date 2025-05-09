<?php
namespace App\Tests;

use App\Config\Container;
use App\Services\EntrepriseService;
use App\Services\ContactService;
use App\Services\StageService;
use App\Models\Entreprise;
use App\Models\Contact;
use App\Models\Stage;

class FunctionalTestRunner
{
    private array $results = [];
    private int $passed = 0;
    private int $failed = 0;
    private array $errors = [];
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function runAllTests(): array
    {
        $this->results = [];
        $this->passed = 0;
        $this->failed = 0;
        $this->errors = [];

        $this->runDatabaseConnectionTest();
        $this->runEntrepriseTests();
        $this->runContactTests();
        $this->runStageTests();
        $this->runRouteTests();

        return $this->results;
    }

    public function getSummary(): array
    {
        return [
            'total' => $this->passed + $this->failed,
            'passed' => $this->passed,
            'failed' => $this->failed,
            'errors' => $this->errors
        ];
    }

    private function runDatabaseConnectionTest(): void
    {
        try {
            $pdo = $this->container->get('PDO');
            $stmt = $pdo->query('SELECT 1');
            $result = $stmt->fetch();
            
            if ($result) {
                $this->recordSuccess('Database Connection', 'Successfully connected to database');
            } else {
                $this->recordFailure('Database Connection', 'Could not verify database connection');
            }
        } catch (\Exception $e) {
            $this->recordFailure('Database Connection', 'Exception: ' . $e->getMessage());
        }
    }

    private function runEntrepriseTests(): void
    {
        try {
            $entrepriseService = $this->container->get(EntrepriseService::class);
            
            // Test creation
            $testData = [
                'Nom' => 'Test Entreprise ' . time(),
                'Adresse' => 'Test Adresse',
                'Ville' => 'Test Ville',
                'Code_Postal' => '75000',
                'Pays' => 'France',
                'Email' => 'test@test.com'
            ];
            
            $id = $entrepriseService->createEntreprise($testData);
            if ($id > 0) {
                $this->recordSuccess('Entreprise Creation', 'Successfully created test entreprise with ID: ' . $id);
            } else {
                $this->recordFailure('Entreprise Creation', 'Failed to create test entreprise');
                return;
            }
            
            // Test retrieval
            $entreprise = $entrepriseService->getEntrepriseById($id);
            if ($entreprise instanceof Entreprise && $entreprise->getNom() === $testData['Nom']) {
                $this->recordSuccess('Entreprise Retrieval', 'Successfully retrieved test entreprise');
            } else {
                $this->recordFailure('Entreprise Retrieval', 'Failed to retrieve test entreprise or data mismatch');
            }
            
            // Test update
            $updateData = [
                'Nom' => 'Updated Test Entreprise',
                'Email' => 'updated@test.com'
            ];
            $result = $entrepriseService->updateEntreprise($id, $updateData);
            if ($result) {
                $this->recordSuccess('Entreprise Update', 'Successfully updated test entreprise');
            } else {
                $this->recordFailure('Entreprise Update', 'Failed to update test entreprise');
            }
            
            // Test deletion (cleanup)
            $result = $entrepriseService->deleteEntreprise($id);
            if ($result) {
                $this->recordSuccess('Entreprise Deletion', 'Successfully deleted test entreprise');
            } else {
                $this->recordFailure('Entreprise Deletion', 'Failed to delete test entreprise');
            }
            
        } catch (\Exception $e) {
            $this->recordFailure('Entreprise Tests', 'Exception: ' . $e->getMessage());
        }
    }

    private function runContactTests(): void
    {
        try {
            $contactService = $this->container->get(ContactService::class);
            $entrepriseService = $this->container->get(EntrepriseService::class);
            
            // Create a test entreprise for contact
            $testEntreprise = [
                'Nom' => 'Test Entreprise for Contact ' . time()
            ];
            $entrepriseId = $entrepriseService->createEntreprise($testEntreprise);
            
            if ($entrepriseId <= 0) {
                $this->recordFailure('Contact Tests', 'Failed to create test entreprise for contact tests');
                return;
            }
            
            // Test contact creation
            $testContact = [
                'Nom' => 'Test Contact',
                'Prenom' => 'Prénom Test',
                'Email' => 'contact@test.com',
                'Telephone' => '0123456789',
                'Poste' => 'Testeur',
                'ID_Entreprise' => $entrepriseId
            ];
            
            $contactId = $contactService->createContact($testContact);
            if ($contactId > 0) {
                $this->recordSuccess('Contact Creation', 'Successfully created test contact with ID: ' . $contactId);
            } else {
                $this->recordFailure('Contact Creation', 'Failed to create test contact');
                // Clean up entreprise
                $entrepriseService->deleteEntreprise($entrepriseId);
                return;
            }
            
            // Test contact retrieval
            $contact = $contactService->getContactById($contactId);
            if ($contact instanceof Contact && $contact->getNom() === $testContact['Nom']) {
                $this->recordSuccess('Contact Retrieval', 'Successfully retrieved test contact');
            } else {
                $this->recordFailure('Contact Retrieval', 'Failed to retrieve test contact or data mismatch');
            }
            
            // Clean up
            $contactService->deleteContact($contactId);
            $entrepriseService->deleteEntreprise($entrepriseId);
            $this->recordSuccess('Contact Cleanup', 'Successfully cleaned up test contact data');
            
        } catch (\Exception $e) {
            $this->recordFailure('Contact Tests', 'Exception: ' . $e->getMessage());
        }
    }

    private function runStageTests(): void
    {
        try {
            $stageService = $this->container->get(StageService::class);
            $entrepriseService = $this->container->get(EntrepriseService::class);
            
            // Create a test entreprise for stage
            $testEntreprise = [
                'Nom' => 'Test Entreprise for Stage ' . time()
            ];
            $entrepriseId = $entrepriseService->createEntreprise($testEntreprise);
            
            if ($entrepriseId <= 0) {
                $this->recordFailure('Stage Tests', 'Failed to create test entreprise for stage tests');
                return;
            }
            
            // Test stage creation
            $testStage = [
                'Lien_Offre' => 'https://test.com/stage',
                'Description' => 'Description du stage de test',
                'Date_Postulation' => date('Y-m-d'),
                'ID_Entreprise' => $entrepriseId
            ];
            
            $stageId = $stageService->createStage($testStage);
            if ($stageId > 0) {
                $this->recordSuccess('Stage Creation', 'Successfully created test stage with ID: ' . $stageId);
            } else {
                $this->recordFailure('Stage Creation', 'Failed to create test stage');
                // Clean up
                $entrepriseService->deleteEntreprise($entrepriseId);
                return;
            }
            
            // Test stage retrieval
            $stage = $stageService->getStageById($stageId);
            if ($stage instanceof Stage && $stage->getDescription() === $testStage['Description']) {
                $this->recordSuccess('Stage Retrieval', 'Successfully retrieved test stage');
            } else {
                $this->recordFailure('Stage Retrieval', 'Failed to retrieve test stage or data mismatch');
            }
            
            // Clean up
            $stageService->deleteStage($stageId);
            $entrepriseService->deleteEntreprise($entrepriseId);
            $this->recordSuccess('Stage Cleanup', 'Successfully cleaned up test stage data');
            
        } catch (\Exception $e) {
            $this->recordFailure('Stage Tests', 'Exception: ' . $e->getMessage());
        }
    }

    private function runRouteTests(): void
    {
        $routes = [
            '/' => 'Test home route',
            '/entreprises' => 'Test entreprises list route',
            '/contacts' => 'Test contacts list route',
            '/stages' => 'Test stages list route'
        ];
        
        foreach ($routes as $route => $description) {
            try {
                $ch = curl_init('http://' . $_SERVER['HTTP_HOST'] . $route);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($httpCode === 200) {
                    $this->recordSuccess('Route Test: ' . $route, 'Route responded with HTTP 200');
                } else {
                    $this->recordFailure('Route Test: ' . $route, 'Route responded with HTTP ' . $httpCode);
                }
            } catch (\Exception $e) {
                $this->recordFailure('Route Test: ' . $route, 'Exception: ' . $e->getMessage());
            }
        }
    }

    private function recordSuccess(string $testName, string $message): void
    {
        $this->results[] = [
            'name' => $testName,
            'status' => 'success',
            'message' => $message
        ];
        $this->passed++;
    }

    private function recordFailure(string $testName, string $message): void
    {
        $this->results[] = [
            'name' => $testName,
            'status' => 'failure',
            'message' => $message
        ];
        $this->failed++;
        $this->errors[] = $testName . ': ' . $message;
    }
}