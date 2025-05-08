<?php
// src/Models/Stage.php
namespace App\Models;

class Stage
{
    private int $id = 0;
    private ?string $lienOffre = null;
    private ?string $description = null;
    private ?string $datePostulation = null;
    private int $idEntreprise = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getLienOffre(): ?string
    {
        return $this->lienOffre;
    }

    public function setLienOffre(?string $lienOffre): self
    {
        $this->lienOffre = $lienOffre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDatePostulation(): ?string
    {
        return $this->datePostulation;
    }

    public function setDatePostulation(?string $datePostulation): self
    {
        $this->datePostulation = $datePostulation;
        return $this;
    }

    public function getIdEntreprise(): int
    {
        return $this->idEntreprise;
    }

    public function setIdEntreprise(int $idEntreprise): self
    {
        $this->idEntreprise = $idEntreprise;
        return $this;
    }
}