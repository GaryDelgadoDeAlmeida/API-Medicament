<?php

namespace App\Entity;

use App\Repository\AvisSMRRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisSMRRepository::class)
 */
class AvisSMR
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
    private $codeHAS;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EvaluationMotive;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\Column(type="text")
     */
    private $wording;

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

    public function getCodeHAS(): ?string
    {
        return $this->codeHAS;
    }

    public function setCodeHAS(string $codeHAS): self
    {
        $this->codeHAS = $codeHAS;

        return $this;
    }

    public function getEvaluationMotive(): ?string
    {
        return $this->EvaluationMotive;
    }

    public function setEvaluationMotive(string $EvaluationMotive): self
    {
        $this->EvaluationMotive = $EvaluationMotive;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }
}
