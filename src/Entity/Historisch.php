<?php

namespace App\Entity;

use App\Repository\HistorischRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistorischRepository::class)
 */
class Historisch
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thema;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titelbild;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beschreibung;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referenzen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quellen;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

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

    public function getThema(): ?string
    {
        return $this->thema;
    }

    public function setThema(?string $thema): self
    {
        $this->thema = $thema;

        return $this;
    }

    public function getTitelbild(): ?string
    {
        return $this->titelbild;
    }

    public function setTitelbild(?string $titelbild): self
    {
        $this->titelbild = $titelbild;

        return $this;
    }

    public function getBeschreibung(): ?string
    {
        return $this->beschreibung;
    }

    public function setBeschreibung(?string $beschreibung): self
    {
        $this->beschreibung = $beschreibung;

        return $this;
    }

    public function getReferenzen(): ?string
    {
        return $this->referenzen;
    }

    public function setReferenzen(?string $referenzen): self
    {
        $this->referenzen = $referenzen;

        return $this;
    }

    public function getQuellen(): ?string
    {
        return $this->quellen;
    }

    public function setQuellen(?string $quellen): self
    {
        $this->quellen = $quellen;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }
}
