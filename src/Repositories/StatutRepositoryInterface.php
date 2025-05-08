<?php
// src/Repositories/StatutRepositoryInterface.php
namespace App\Repositories;

use App\Models\Statut;

interface StatutRepositoryInterface
{
    /**
     * @return Statut[]
     */
    public function findAll(): array;

    public function findById(int $id): ?Statut;

    /**
     * @return int ID of the created statut
     */
    public function save(Statut $statut): int;

    public function update(Statut $statut): bool;

    public function delete(int $id): bool;
}
