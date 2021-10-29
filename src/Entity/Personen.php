<?php

namespace App\Entity;

use App\Repository\PersonenRepository;
use App\Service\UploaderHelper;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonenRepository::class)
 */
class Personen
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vorname;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $kontakt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beschreibung;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $geboren;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $wohnhaftAb;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $wohnhaftBis;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $rollen = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="personen", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVorname(): ?string
    {
        return $this->vorname;
    }

    public function setVorname(?string $vorname): self
    {
        $this->vorname = $vorname;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse): self
    {
        $this->adresse = $adresse;

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

    public function getBeschreibung(): ?string
    {
        return $this->beschreibung;
    }

    public function setBeschreibung(?string $beschreibung): self
    {
        $this->beschreibung = $beschreibung;

        return $this;
    }

    public function getGeboren(): ?DateTimeInterface
    {
        return $this->geboren;
    }

    public function setGeboren(?DateTimeInterface $geboren): self
    {
        $this->geboren = $geboren;

        return $this;
    }

    public function getWohnhaftAb(): ?DateTimeInterface
    {
        return $this->wohnhaftAb;
    }

    public function setWohnhaftAb(?DateTimeInterface $wohnhaftAb): self
    {
        $this->wohnhaftAb = $wohnhaftAb;

        return $this;
    }

    public function getWohnhaftBis(): ?DateTimeInterface
    {
        return $this->wohnhaftBis;
    }

    public function setWohnhaftBis(?DateTimeInterface $wohnhaftBis): self
    {
        $this->wohnhaftBis = $wohnhaftBis;

        return $this;
    }

    public function getRollen(): ?array
    {
        return $this->rollen;
    }

    public function setRollen(?array $rollen): self
    {
        $this->rollen = $rollen;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getImagePath(): ?string
    {

        return '/uploads/'.UploaderHelper::PERSON_IMAGE.'/'.$this->getFoto();

    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
