<?php
// src/Repositories/CandidatureRepositoryInterface.php
namespace App\Repositories;

use App\Models\Candidature;

interface CandidatureRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?Candidature;
    public function findByStageId(int $stageId): ?Candidature;
    public function save(Candidature $candidature): int;
    public function update(Candidature $candidature): bool;
    public function delete(int $id): bool;
    public function deleteByStageId(int $stageId): bool;
}
