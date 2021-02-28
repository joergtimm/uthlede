<?php

namespace App\Entity;

use App\Repository\ArticelRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ArticelRepository::class)
 */
class Articel
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
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $kurztext;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $haupttext;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bild;

    /**
     * @ORM\Column(type="integer")
     */
    private $views = 0;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datum;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"titel"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Themen::class, inversedBy="articels")
     */
    private $thema;

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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getKurztext(): ?string
    {
        return $this->kurztext;
    }

    public function setKurztext(?string $kurztext): self
    {
        $this->kurztext = $kurztext;

        return $this;
    }

    public function getHaupttext(): ?string
    {
        return $this->haupttext;
    }

    public function setHaupttext(?string $haupttext): self
    {
        $this->haupttext = $haupttext;

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

    public function getImagePath(): ?string
    {
        return 'uploads/'.UploaderHelper::ARTIKEL_IMAGE.'/'.$this->getBild();
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

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

    public function getThema(): ?Themen
    {
        return $this->thema;
    }

    public function setThema(?Themen $thema): self
    {
        $this->thema = $thema;

        return $this;
    }
}
