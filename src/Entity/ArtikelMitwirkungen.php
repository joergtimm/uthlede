<?php

namespace App\Entity;

use App\Repository\ArtikelMitwirkungenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtikelMitwirkungenRepository::class)
 */
class ArtikelMitwirkungen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $art;

    /**
     * @ORM\ManyToOne(targetEntity=Articel::class, inversedBy="artikelMitwirkungens")
     */
    private $artikel;

    /**
     * @ORM\ManyToOne(targetEntity=Personen::class, inversedBy="artikelMitwirkungens")
     */
    private $person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArt(): ?string
    {
        return $this->art;
    }

    public function setArt(?string $art): self
    {
        $this->art = $art;

        return $this;
    }

    public function getArtikel(): ?Articel
    {
        return $this->artikel;
    }

    public function setArtikel(?Articel $artikel): self
    {
        $this->artikel = $artikel;

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
