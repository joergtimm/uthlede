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
     * @ORM\Column(type="string", length=255)
     */
    private $Art;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArt(): ?string
    {
        return $this->Art;
    }

    public function setArt(string $Art): self
    {
        $this->Art = $Art;

        return $this;
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
}
