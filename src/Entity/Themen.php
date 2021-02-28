<?php

namespace App\Entity;

use App\Repository\ThemenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ThemenRepository::class)
 */
class Themen
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
    private $bild;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rang = 0;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"titel"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Articel::class, mappedBy="thema")
     */
    private $articels;

    public function __construct()
    {
        $this->articels = new ArrayCollection();
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

    public function getBild(): ?string
    {
        return $this->bild;
    }

    public function setBild(?string $bild): self
    {
        $this->bild = $bild;

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(?int $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Articel[]
     */
    public function getArticels(): Collection
    {
        return $this->articels;
    }

    public function addArticel(Articel $articel): self
    {
        if (!$this->articels->contains($articel)) {
            $this->articels[] = $articel;
            $articel->setThema($this);
        }

        return $this;
    }

    public function removeArticel(Articel $articel): self
    {
        if ($this->articels->removeElement($articel)) {
            // set the owning side to null (unless already changed)
            if ($articel->getThema() === $this) {
                $articel->setThema(null);
            }
        }

        return $this;
    }
}
