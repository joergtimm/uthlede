<?php

namespace App\Entity;

use App\Repository\PersVerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersVerRepository::class)
 */
class PersVer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rolle;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $kontakt;

    /**
     * @ORM\ManyToOne(targetEntity=Personen::class, inversedBy="persVers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $art;

    /**
     * @ORM\ManyToOne(targetEntity=Vereine::class, inversedBy="persVers")
     */
    private $verein;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ansprechpartner;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getRolle(): ?string
    {
        return $this->rolle;
    }

    public function setRolle(?string $rolle): self
    {
        $this->rolle = $rolle;

        return $this;
    }

    public function getKontakt()
    {
        return $this->kontakt;
    }

    public function setKontakt($kontakt): self
    {
        $this->kontakt = $kontakt;

        return $this;
    }

    public function getPerson(): ?Personen
    {
        return $this->person;
    }

    public function setPerson(?Personen $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getArt(): ?string
    {
        return $this->art;
    }

    public function setArt(string $art): self
    {
        $this->art = $art;

        return $this;
    }

    public function getVerein(): ?Vereine
    {
        return $this->verein;
    }

    public function setVerein(?Vereine $verein): self
    {
        $this->verein = $verein;

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

    public function getAnsprechpartner(): ?bool
    {
        return $this->ansprechpartner;
    }

    public function setAnsprechpartner(?bool $ansprechpartner): self
    {
        $this->ansprechpartner = $ansprechpartner;

        return $this;
    }
}
