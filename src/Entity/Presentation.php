<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresentationRepository")
 */
class Presentation
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
     * @ORM\Column(type="integer")
     */
    private $codeCIP;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $administrationStatus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marketingStatus;

    /**
     * @ORM\Column(type="date")
     */
    private $marketingDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeCIP13;

    /**
     * @ORM\Column(type="boolean")
     */
    private $collectivityAgreement;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $repaymentPercentageRate;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $medicationPrice = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $indicationRepaymentRight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCIP(): ?int
    {
        return $this->codeCIP;
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

    public function setCodeCIP(int $codeCIP): self
    {
        $this->codeCIP = $codeCIP;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdministrationStatus(): ?string
    {
        return $this->administrationStatus;
    }

    public function setAdministrationStatus(string $administrationStatus): self
    {
        $this->administrationStatus = $administrationStatus;

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

    public function getMarketingDate(): ?\DateTimeInterface
    {
        return $this->marketingDate;
    }

    public function setMarketingDate(\DateTimeInterface $marketingDate): self
    {
        $this->marketingDate = $marketingDate;

        return $this;
    }

    public function getCodeCIP13(): ?int
    {
        return $this->codeCIP13;
    }

    public function setCodeCIP13(int $codeCIP13): self
    {
        $this->codeCIP13 = $codeCIP13;

        return $this;
    }

    public function getCollectivityAgreement(): ?bool
    {
        return $this->collectivityAgreement;
    }

    public function setCollectivityAgreement(bool $collectivityAgreement): self
    {
        $this->collectivityAgreement = $collectivityAgreement;

        return $this;
    }

    public function getRepaymentPercentageRate(): ?float
    {
        return $this->repaymentPercentageRate;
    }

    public function setRepaymentPercentageRate(?float $repaymentPercentageRate): self
    {
        $this->repaymentPercentageRate = $repaymentPercentageRate;

        return $this;
    }

    public function getMedicationPrice(): ?array
    {
        return $this->medicationPrice;
    }

    public function setMedicationPrice(?array $medicationPrice): self
    {
        $this->medicationPrice = $medicationPrice;

        return $this;
    }

    public function getIndicationRepaymentRight(): ?string
    {
        return $this->indicationRepaymentRight;
    }

    public function setIndicationRepaymentRight(?string $indicationRepaymentRight): self
    {
        $this->indicationRepaymentRight = $indicationRepaymentRight;

        return $this;
    }
}
