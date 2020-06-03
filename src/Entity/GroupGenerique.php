<?php

namespace App\Entity;

use App\Repository\GroupGeneriqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupGeneriqueRepository::class)
 */
class GroupGenerique
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
    private $idGroupGenerique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameGroupeGenerique;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeCIS;

    /**
     * @ORM\Column(type="integer")
     */
    private $typeGenerique;

    /**
     * @ORM\Column(type="integer")
     */
    private $numTri;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $otherData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGroupGenerique(): ?int
    {
        return $this->idGroupGenerique;
    }

    public function setIdGroupGenerique(int $idGroupGenerique): self
    {
        $this->idGroupGenerique = $idGroupGenerique;

        return $this;
    }

    public function getNameGroupeGenerique(): ?string
    {
        return $this->nameGroupeGenerique;
    }

    public function setNameGroupeGenerique(string $nameGroupeGenerique): self
    {
        $this->nameGroupeGenerique = $nameGroupeGenerique;

        return $this;
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

    public function getTypeGenerique(): ?int
    {
        return $this->typeGenerique;
    }

    public function setTypeGenerique(int $typeGenerique): self
    {
        $this->typeGenerique = $typeGenerique;

        return $this;
    }

    public function getNumTri(): ?int
    {
        return $this->numTri;
    }

    public function setNumTri(int $numTri): self
    {
        $this->numTri = $numTri;

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
