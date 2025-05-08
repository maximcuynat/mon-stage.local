<?php
// src/Repositories/PDO/CandidatureRepository.php
namespace App\Repositories\PDO;

use App\Models\Candidature;
use App\Repositories\CandidatureRepositoryInterface;
use PDO;

class CandidatureRepository implements CandidatureRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM Candidatures ORDER BY ID DESC');
        $candidatures = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $candidatures[] = $this->hydrate($row);
        }

        return $candidatures;
    }

    public function findById(int $id): ?Candidature
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Candidatures WHERE ID = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function findByStageId(int $stageId): ?Candidature
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Candidatures WHERE ID_Stage = ?');
        $stmt->execute([$stageId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function save(Candidature $candidature): int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO Candidatures (ID_Stage, ID_Statut, Date_Candidature, Commentaires) 
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $candidature->getStageId(),
            $candidature->getStatutId(),
            $candidature->getDateCandidature(),
            $candidature->getCommentaires()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(Candidature $candidature): bool
    {
        $stmt = $this->pdo->prepare('
            UPDATE Candidatures 
            SET ID_Stage = ?, ID_Statut = ?, Date_Candidature = ?, Commentaires = ?
            WHERE ID = ?
        ');

        return $stmt->execute([
            $candidature->getStageId(),
            $candidature->getStatutId(),
            $candidature->getDateCandidature(),
            $candidature->getCommentaires(),
            $candidature->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM Candidatures WHERE ID = ?');
        return $stmt->execute([$id]);
    }

    public function deleteByStageId(int $stageId): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM Candidatures WHERE ID_Stage = ?');
        return $stmt->execute([$stageId]);
    }

    private function hydrate(array $row): Candidature
    {
        return (new Candidature())
            ->setId((int) $row['ID'])
            ->setStageId((int) $row['ID_Stage'])
            ->setStatutId((int) $row['ID_Statut'])
            ->setDateCandidature($row['Date_Candidature'])
            ->setCommentaires($row['Commentaires']);
    }
}
