<?php
// src/Repositories/StageRepositoryInterface.php
namespace App\Repositories;

use App\Models\Stage;

interface StageRepositoryInterface
{
    /**
     * @return Stage[]
     */
    public function findAll(): array;

    public function findById(int $id): ?Stage;

    /**
     * @return Stage[]
     */
    public function findByEntrepriseId(int $entrepriseId): array;

    /**
     * @return int ID of the created stage
     */
    public function save(Stage $stage): int;

    public function update(Stage $stage): bool;

    public function delete(int $id): bool;
}
