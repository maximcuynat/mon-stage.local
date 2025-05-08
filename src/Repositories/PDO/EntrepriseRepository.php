<?php
// src/Repositories/PDO/EntrepriseRepository.php
namespace App\Repositories\PDO;

use App\Models\Entreprise;
use App\Repositories\EntrepriseRepositoryInterface;
use PDO;

class EntrepriseRepository implements EntrepriseRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM Entreprises ORDER BY ID DESC');
        $entreprises = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $entreprises[] = $this->hydrate($row);
        }

        return $entreprises;
    }

    public function findById(int $id): ?Entreprise
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Entreprises WHERE ID = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function findByNom(string $nom): ?Entreprise
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Entreprises WHERE Nom = ?');
        $stmt->execute([$nom]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function save(Entreprise $entreprise): int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO Entreprises (
                Nom, Adresse, Ville, Code_Postal, Pays, Telephone, Site_Web, Email, Liens_Offre
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $entreprise->getNom(),
            $entreprise->getAdresse(),
            $entreprise->getVille(),
            $entreprise->getCodePostal(),
            $entreprise->getPays(),
            $entreprise->getTelephone(),
            $entreprise->getSiteWeb(),
            $entreprise->getEmail(),
            $entreprise->getLiensOffre()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(Entreprise $entreprise): bool
    {
        $stmt = $this->pdo->prepare('
            UPDATE Entreprises 
            SET Nom = ?, 
                Adresse = ?, 
                Ville = ?, 
                Code_Postal = ?, 
                Pays = ?, 
                Telephone = ?, 
                Site_Web = ?, 
                Email = ?, 
                Liens_Offre = ?
            WHERE ID = ?
        ');

        return $stmt->execute([
            $entreprise->getNom(),
            $entreprise->getAdresse(),
            $entreprise->getVille(),
            $entreprise->getCodePostal(),
            $entreprise->getPays(),
            $entreprise->getTelephone(),
            $entreprise->getSiteWeb(),
            $entreprise->getEmail(),
            $entreprise->getLiensOffre(),
            $entreprise->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM Entreprises WHERE ID = ?');
        return $stmt->execute([$id]);
    }

    private function hydrate(array $row): Entreprise
    {
        $entreprise = new Entreprise();
        $entreprise->setId((int) $row['ID'])
            ->setNom($row['Nom'])
            ->setAdresse($row['Adresse'] ?? null)
            ->setVille($row['Ville'] ?? null)
            ->setCodePostal($row['Code_Postal'] ?? null)
            ->setPays($row['Pays'] ?? null)
            ->setTelephone($row['Telephone'] ?? null)
            ->setSiteWeb($row['Site_Web'] ?? null)
            ->setEmail($row['Email'] ?? null)
            ->setLiensOffre($row['Liens_Offre'] ?? null);

        return $entreprise;
    }
}
