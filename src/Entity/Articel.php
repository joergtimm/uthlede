<?php

namespace App\Entity;

use App\Repository\ArticelRepository;
use App\Service\UploaderHelper;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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

    /**
     * @ORM\OneToMany(targetEntity=ArtikelBilder::class, mappedBy="artikel", orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $artikelBilders;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $top;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $extra = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $oldId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articels")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="articel")
     */
    private $comments;

    public function __construct()
    {
        $this->artikelBilders = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getCreateAt(): ?DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTimeInterface $createAt): self
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
        return '/uploads/'.UploaderHelper::ARTIKEL_IMAGE.'/'.$this->getBild();
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

    public function getDatum(): ?DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?DateTimeInterface $datum): self
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

    /**
     * @return Collection|ArtikelBilder[]
     */
    public function getArtikelBilders(): Collection
    {
        return $this->artikelBilders;
    }

    public function addArtikelBilder(ArtikelBilder $artikelBilder): self
    {
        if (!$this->artikelBilders->contains($artikelBilder)) {
            $this->artikelBilders[] = $artikelBilder;
            $artikelBilder->setArtikel($this);
        }

        return $this;
    }

    public function removeArtikelBilder(ArtikelBilder $artikelBilder): self
    {
        if ($this->artikelBilders->removeElement($artikelBilder)) {
            // set the owning side to null (unless already changed)
            if ($artikelBilder->getArtikel() === $this) {
                $artikelBilder->setArtikel(null);
            }
        }

        return $this;
    }

    public function getTop(): ?bool
    {
        return $this->top;
    }

    public function setTop(?bool $top): self
    {
        $this->top = $top;

        return $this;
    }

    public function getExtra(): ?array
    {
        return $this->extra;
    }

    public function setExtra(?array $extra): self
    {
        $this->extra = $extra;

        return $this;
    }

    public function addExtra(?array $extra): self
    {
        $extras = $this->getExtra();
        if (!in_array($extra, $extras)){
            array_push($extras, $extra);
        }

        return $this;
    }

    public function getOldId(): ?int
    {
        return $this->oldId;
    }

    public function setOldId(?int $oldId): self
    {
        $this->oldId = $oldId;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticel($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticel() === $this) {
                $comment->setArticel(null);
            }
        }

        return $this;
    }
}
