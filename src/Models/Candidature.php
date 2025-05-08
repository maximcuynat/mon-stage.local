<?php
// src/Models/Candidature.php
namespace App\Models;

class Candidature
{
    private int $id;
    private int $stageId;
    private int $statutId;
    private string $dateCandidature;
    private ?string $commentaires;

    public function __construct(
        int $id = 0,
        int $stageId = 0,
        int $statutId = 0,
        string $dateCandidature = '',
        ?string $commentaires = null
    ) {
        $this->id = $id;
        $this->stageId = $stageId;
        $this->statutId = $statutId;
        $this->dateCandidature = $dateCandidature;
        $this->commentaires = $commentaires;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getStageId(): int
    {
        return $this->stageId;
    }

    public function setStageId(int $stageId): self
    {
        $this->stageId = $stageId;
        return $this;
    }

    public function getStatutId(): int
    {
        return $this->statutId;
    }

    public function setStatutId(int $statutId): self
    {
        $this->statutId = $statutId;
        return $this;
    }

    public function getDateCandidature(): string
    {
        return $this->dateCandidature;
    }

    public function setDateCandidature(string $dateCandidature): self
    {
        $this->dateCandidature = $dateCandidature;
        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;
        return $this;
    }
}