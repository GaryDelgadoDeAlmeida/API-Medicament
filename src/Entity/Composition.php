<?php

namespace App\Entity;

use App\Repository\CompositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompositionRepository::class)
 */
class Composition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeCIS;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designationPharmaceuticalElement;

    /**
     * @ORM\Column(type="integer")
     */
    private $substanceCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $substanceDenomination;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $substanceDosage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dosageReference;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $componentNature;

    /**
     * @ORM\Column(type="integer")
     */
    private $numLink;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $otherData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCIS(): ?int
    {
        return $this->codeCIS;
    }

    public function setCodeCIS(int $codeCIS): self
    {
        $this->codeCIS = $codeCIS;

        return $this;
    }

    public function getDesignationPharmaceuticalElement(): ?string
    {
        return $this->designationPharmaceuticalElement;
    }

    public function setDesignationPharmaceuticalElement(string $designationPharmaceuticalElement): self
    {
        $this->designationPharmaceuticalElement = $designationPharmaceuticalElement;

        return $this;
    }

    public function getSubstanceCode(): ?int
    {
        return $this->substanceCode;
    }

    public function setSubstanceCode(int $substanceCode): self
    {
        $this->substanceCode = $substanceCode;

        return $this;
    }

    public function getSubstanceDenomination(): ?string
    {
        return $this->substanceDenomination;
    }

    public function setSubstanceDenomination(string $substanceDenomination): self
    {
        $this->substanceDenomination = $substanceDenomination;

        return $this;
    }

    public function getSubstanceDosage(): ?string
    {
        return $this->substanceDosage;
    }

    public function setSubstanceDosage(?string $substanceDosage): self
    {
        $this->substanceDosage = $substanceDosage;

        return $this;
    }

    public function getDosageReference(): ?string
    {
        return $this->dosageReference;
    }

    public function setDosageReference(?string $dosageReference): self
    {
        $this->dosageReference = $dosageReference;

        return $this;
    }

    public function getComponentNature(): ?string
    {
        return $this->componentNature;
    }

    public function setComponentNature(string $componentNature): self
    {
        $this->componentNature = $componentNature;

        return $this;
    }

    public function getNumLink(): ?int
    {
        return $this->numLink;
    }

    public function setNumLink(int $numLink): self
    {
        $this->numLink = $numLink;

        return $this;
    }

    public function getOtherData(): ?string
    {
        return $this->otherData;
    }

    public function setOtherData(?string $otherData): self
    {
        $this->otherData = $otherData;

        return $this;
    }
}
