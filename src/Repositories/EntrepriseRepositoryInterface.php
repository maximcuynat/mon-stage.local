<?php
// src/Repositories/EntrepriseRepositoryInterface.php
namespace App\Repositories;

use App\Models\Entreprise;

interface EntrepriseRepositoryInterface
{
    /**
     * @return Entreprise[]
     */
    public function findAll(): array;

    public function findById(int $id): ?Entreprise;

    public function findByNom(string $nom): ?Entreprise;

    /**
     * @return int ID of the created entreprise
     */
    public function save(Entreprise $entreprise): int;

    public function update(Entreprise $entreprise): bool;

    public function delete(int $id): bool;
}
