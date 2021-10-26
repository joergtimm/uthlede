<?php

namespace App\Entity;

use App\Repository\VideosRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideosRepository::class)
 */
class Videos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $embed_code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $einstellungAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): self
    {
        $this->titel = $titel;

        return $this;
    }

    public function getQuelle(): ?string
    {
        return $this->quelle;
    }

    public function setQuelle(string $quelle): self
    {
        $this->quelle = $quelle;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getEmbedCode(): ?string
    {
        return $this->embed_code;
    }

    public function setEmbedCode(?string $embed_code): self
    {
        $this->embed_code = $embed_code;

        return $this;
    }

    public function getEinstellungAt(): ?DateTimeInterface
    {
        return $this->einstellungAt;
    }

    public function setEinstellungAt(DateTimeInterface $einstellungAt): self
    {
        $this->einstellungAt = $einstellungAt;

        return $this;
    }
}
