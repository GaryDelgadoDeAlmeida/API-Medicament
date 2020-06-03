<?php

namespace App\Entity;

use App\Repository\InfoImportantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfoImportantRepository::class)
 */
class InfoImportant
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
     * @ORM\Column(type="date")
     */
    private $dateStartSecurityInfo;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEndSecurityInfo;

    /**
     * @ORM\Column(type="text")
     */
    private $additionalInfo;

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

    public function getDateStartSecurityInfo(): ?\DateTimeInterface
    {
        return $this->dateStartSecurityInfo;
    }

    public function setDateStartSecurityInfo(\DateTimeInterface $dateStartSecurityInfo): self
    {
        $this->dateStartSecurityInfo = $dateStartSecurityInfo;

        return $this;
    }

    public function getDateEndSecurityInfo(): ?\DateTimeInterface
    {
        return $this->dateEndSecurityInfo;
    }

    public function setDateEndSecurityInfo(\DateTimeInterface $dateEndSecurityInfo): self
    {
        $this->dateEndSecurityInfo = $dateEndSecurityInfo;

        return $this;
    }

    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(string $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;

        return $this;
    }
}
