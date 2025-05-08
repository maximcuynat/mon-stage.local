<?php
// src/Repositories/PDO/ContactRepository.php
namespace App\Repositories\PDO;

use App\Models\Contact;
use App\Repositories\ContactRepositoryInterface;
use PDO;

class ContactRepository implements ContactRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM Contacts ORDER BY ID DESC');
        $contacts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = $this->hydrate($row);
        }

        return $contacts;
    }

    public function findById(int $id): ?Contact
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Contacts WHERE ID = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function findByEntrepriseId(int $entrepriseId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Contacts WHERE ID_Entreprise = ? ORDER BY ID DESC');
        $stmt->execute([$entrepriseId]);

        $contacts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = $this->hydrate($row);
        }

        return $contacts;
    }

    public function save(Contact $contact): int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO Contacts (Nom, Prenom, Email, Telephone, Poste, ID_Entreprise) 
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $contact->getNom(),
            $contact->getPrenom(),
            $contact->getEmail(),
            $contact->getTelephone(),
            $contact->getPoste(),
            $contact->getIdEntreprise()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(Contact $contact): bool
    {
        $stmt = $this->pdo->prepare('
            UPDATE Contacts 
            SET Nom = ?, 
                Prenom = ?, 
                Email = ?, 
                Telephone = ?, 
                Poste = ?, 
                ID_Entreprise = ?
            WHERE ID = ?
        ');

        return $stmt->execute([
            $contact->getNom(),
            $contact->getPrenom(),
            $contact->getEmail(),
            $contact->getTelephone(),
            $contact->getPoste(),
            $contact->getIdEntreprise(),
            $contact->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM Contacts WHERE ID = ?');
        return $stmt->execute([$id]);
    }

    private function hydrate(array $row): Contact
    {
        $contact = new Contact();
        $contact->setId((int) $row['ID'])
            ->setNom($row['Nom'])
            ->setPrenom($row['Prenom'])
            ->setEmail($row['Email'])
            ->setTelephone($row['Telephone'])
            ->setPoste($row['Poste'])
            ->setIdEntreprise((int) $row['ID_Entreprise']);

        return $contact;
    }
}
