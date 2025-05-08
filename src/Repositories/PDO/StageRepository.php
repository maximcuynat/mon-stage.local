<?php
// src/Repositories/PDO/StageRepository.php
namespace App\Repositories\PDO;

use App\Models\Stage;
use App\Repositories\StageRepositoryInterface;
use PDO;

class StageRepository implements StageRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM Stages ORDER BY ID DESC');
        $stages = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stages[] = $this->hydrate($row);
        }

        return $stages;
    }

    public function findById(int $id): ?Stage
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Stages WHERE ID = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function findByEntrepriseId(int $entrepriseId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Stages WHERE ID_Entreprise = ? ORDER BY ID DESC');
        $stmt->execute([$entrepriseId]);

        $stages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stages[] = $this->hydrate($row);
        }

        return $stages;
    }

    public function save(Stage $stage): int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO Stages (Lien_Offre, Description, Date_Postulation, ID_Entreprise) 
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $stage->getLienOffre(),
            $stage->getDescription(),
            $stage->getDatePostulation(),
            $stage->getIdEntreprise()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(Stage $stage): bool
    {
        $stmt = $this->pdo->prepare('
            UPDATE Stages 
            SET Lien_Offre = ?, 
                Description = ?, 
                Date_Postulation = ?, 
                ID_Entreprise = ?
            WHERE ID = ?
        ');

        return $stmt->execute([
            $stage->getLienOffre(),
            $stage->getDescription(),
            $stage->getDatePostulation(),
            $stage->getIdEntreprise(),
            $stage->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM Stages WHERE ID = ?');
        return $stmt->execute([$id]);
    }

    private function hydrate(array $row): Stage
    {
        $stage = new Stage();
        $stage->setId((int) $row['ID'])
            ->setLienOffre($row['Lien_Offre'])
            ->setDescription($row['Description'])
            ->setDatePostulation($row['Date_Postulation'])
            ->setIdEntreprise((int) $row['ID_Entreprise']);

        return $stage;
    }
}
