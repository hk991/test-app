<?php

declare(strict_types=1);

namespace App\Entity\Batiment;

interface AppartementInterface
{
    public function getAdresse(): ?string;

    public function setAdresse(string $adresse): self;

    public function getEtage(): ?int;

    public function setEtage(int $etage): self;

    public function getNombrePieces(): ?int;

    public function setNombrePieces(int $nombrePieces): self;

    public function getAscenceur(): ?bool;

    public function setAscenceur(?bool $ascenceur): self;
}
