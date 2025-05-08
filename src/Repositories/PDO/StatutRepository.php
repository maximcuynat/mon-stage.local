<?php
// src/Repositories/PDO/StatutRepository.php
namespace App\Repositories\PDO;

use App\Models\Statut;
use App\Repositories\StatutRepositoryInterface;
use PDO;

class StatutRepository implements StatutRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM Statuts ORDER BY ID');
        $statuts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $statuts[] = $this->hydrate($row);
        }

        return $statuts;
    }

    public function findById(int $id): ?Statut
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Statuts WHERE ID = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function save(Statut $statut): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO Statuts (Statut) VALUES (?)');
        $stmt->execute([$statut->getLibelle()]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(Statut $statut): bool
    {
        $stmt = $this->pdo->prepare('UPDATE Statuts SET Statut = ? WHERE ID = ?');
        return $stmt->execute([$statut->getLibelle(), $statut->getId()]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM Statuts WHERE ID = ?');
        return $stmt->execute([$id]);
    }

    private function hydrate(array $row): Statut
    {
        $statut = new Statut();
        $statut->setId((int) $row['ID'])
            ->setLibelle($row['Statut']);

        return $statut;
    }
}
