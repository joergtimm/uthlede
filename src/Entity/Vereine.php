<?php

namespace App\Entity;

use App\Repository\VereineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VereineRepository::class)
 */
class Vereine
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aktiv;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beschreibung;

    /**
     * @ORM\ManyToOne(targetEntity=Personen::class)
     */
    private $ansprechpartner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity=PersVer::class, mappedBy="verein")
     */
    private $persVers;


    public function __construct()
    {
        $this->persVereines = new ArrayCollection();
        $this->persVers = new ArrayCollection();
    }


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

    public function getAktiv(): ?bool
    {
        return $this->aktiv;
    }

    public function setAktiv(?bool $aktiv): self
    {
        $this->aktiv = $aktiv;

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

    public function getAnsprechpartner(): ?Personen
    {
        return $this->ansprechpartner;
    }

    public function setAnsprechpartner(?Personen $ansprechpartner): self
    {
        $this->ansprechpartner = $ansprechpartner;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|PersVer[]
     */
    public function getPersVers(): Collection
    {
        return $this->persVers;
    }

    public function addPersVer(PersVer $persVer): self
    {
        if (!$this->persVers->contains($persVer)) {
            $this->persVers[] = $persVer;
            $persVer->setVerein($this);
        }

        return $this;
    }

    public function removePersVer(PersVer $persVer): self
    {
        if ($this->persVers->removeElement($persVer)) {
            // set the owning side to null (unless already changed)
            if ($persVer->getVerein() === $this) {
                $persVer->setVerein(null);
            }
        }

        return $this;
    }


}
