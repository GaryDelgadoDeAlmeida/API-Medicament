<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicamentRepository")
 */
class Medicament
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $denomination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pharmaceuticalForm;

    /**
     * @ORM\Column(type="text")
     */
    private $administrationRoutes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $authorizationStatus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $procedureType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marketingStatus;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bdmStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $europeanAuthorizationNumber;

    /**
     * @ORM\Column(type="text")
     */
    private $holder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reinforcedSurveillance;

    public function __construct()
    {
        $this->presentations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $code_cis): self
    {
        $this->id = $code_cis;

        return $this;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getPharmaceuticalForm(): ?string
    {
        return $this->pharmaceuticalForm;
    }

    public function setPharmaceuticalForm(string $pharmaceuticalForm): self
    {
        $this->pharmaceuticalForm = $pharmaceuticalForm;

        return $this;
    }

    public function getAdministrationRoutes(): ?string
    {
        return $this->administrationRoutes;
    }

    public function setAdministrationRoutes(string $administrationRoutes): self
    {
        $this->administrationRoutes = $administrationRoutes;

        return $this;
    }

    public function getAuthorizationStatus(): ?string
    {
        return $this->authorizationStatus;
    }

    public function setAuthorizationStatus(string $authorizationStatus): self
    {
        $this->authorizationStatus = $authorizationStatus;

        return $this;
    }

    public function getProcedureType(): ?string
    {
        return $this->procedureType;
    }

    public function setProcedureType(string $procedureType): self
    {
        $this->procedureType = $procedureType;

        return $this;
    }

    public function getMarketingStatus(): ?string
    {
        return $this->marketingStatus;
    }

    public function setMarketingStatus(string $marketingStatus): self
    {
        $this->marketingStatus = $marketingStatus;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBdmStatus(): ?string
    {
        return $this->bdmStatus;
    }

    public function setBdmStatus(?string $bdmStatus): self
    {
        $this->bdmStatus = $bdmStatus;

        return $this;
    }

    public function getEuropeanAuthorizationNumber(): ?string
    {
        return $this->europeanAuthorizationNumber;
    }

    public function setEuropeanAuthorizationNumber(?string $europeanAuthorizationNumber): self
    {
        $this->europeanAuthorizationNumber = $europeanAuthorizationNumber;

        return $this;
    }

    public function getHolder(): ?string
    {
        return $this->holder;
    }

    public function setHolder(string $holder): self
    {
        $this->holder = $holder;

        return $this;
    }

    public function getReinforcedSurveillance(): ?bool
    {
        return $this->reinforcedSurveillance;
    }

    public function setReinforcedSurveillance(bool $reinforcedSurveillance): self
    {
        $this->reinforcedSurveillance = $reinforcedSurveillance;

        return $this;
    }
}
