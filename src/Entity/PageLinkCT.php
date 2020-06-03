<?php

namespace App\Entity;

use App\Repository\PageLinkCTRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageLinkCTRepository::class)
 */
class PageLinkCT
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeHAS;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeHAS(): ?int
    {
        return $this->codeHAS;
    }

    public function setCodeHAS(string $codeHAS): self
    {
        $this->codeHAS = $codeHAS;

        return $this;
    }

    public function getLinkUrl(): ?string
    {
        return $this->linkUrl;
    }

    public function setLinkUrl(string $linkUrl): self
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }
}
