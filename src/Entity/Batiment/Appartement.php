<?php

declare(strict_types=1);

namespace App\Entity\Batiment;

use App\Repository\Batiment\AppartementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AppartementRepository::class)
 * @UniqueEntity(fields={"adresse"}, message="Cette adresse existe déjà.")
 */
class Appartement implements AppartementInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $adresse;

    /**
     * @Assert\GreaterThanOrEqual(
     *     value = 0,
     *     message="Cette valeur doit etre supérieur à {{ compared_value }}"
     * )
     * @ORM\Column(type="integer")
     */
    private $etage;

    /**
     * @Assert\GreaterThanOrEqual(
     *     value = 1,
     *     message="Cette valeur doit etre supérieur à {{ compared_value }}"
     * )
     * @ORM\Column(type="integer")
     */
    private $nombrePieces;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ascenceur = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): AppartementInterface
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): AppartementInterface
    {
        $this->etage = $etage;

        return $this;
    }

    public function getNombrePieces(): ?int
    {
        return $this->nombrePieces;
    }

    public function setNombrePieces(int $nombrePieces): AppartementInterface
    {
        $this->nombrePieces = $nombrePieces;

        return $this;
    }

    public function getAscenceur(): ?bool
    {
        return $this->ascenceur;
    }

    public function setAscenceur(?bool $ascenceur): AppartementInterface
    {
        $this->ascenceur = $ascenceur;

        return $this;
    }
}
