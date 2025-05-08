<?php
// src/Repositories/ContactRepositoryInterface.php
namespace App\Repositories;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    /**
     * @return Contact[]
     */
    public function findAll(): array;

    public function findById(int $id): ?Contact;

    /**
     * @return Contact[]
     */
    public function findByEntrepriseId(int $entrepriseId): array;

    /**
     * @return int ID of the created contact
     */
    public function save(Contact $contact): int;

    public function update(Contact $contact): bool;

    public function delete(int $id): bool;
}
