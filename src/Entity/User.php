<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=ArtikelMitwirkungen::class, mappedBy="user")
     */
    private $artikelMitwirkungens;

    /**
     * @ORM\OneToMany(targetEntity=Articel::class, mappedBy="author")
     */
    private $articels;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="author")
     */
    private $comments;

    /**
     * @ORM\OneToOne(targetEntity=Personen::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $personen;

    public function __construct()
    {
        $this->artikelMitwirkungens = new ArrayCollection();
        $this->articels = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection|ArtikelMitwirkungen[]
     */
    public function getArtikelMitwirkungens(): Collection
    {
        return $this->artikelMitwirkungens;
    }

    public function addArtikelMitwirkungen(ArtikelMitwirkungen $artikelMitwirkungen): self
    {
        if (!$this->artikelMitwirkungens->contains($artikelMitwirkungen)) {
            $this->artikelMitwirkungens[] = $artikelMitwirkungen;
            $artikelMitwirkungen->setUser($this);
        }

        return $this;
    }

    public function removeArtikelMitwirkungen(ArtikelMitwirkungen $artikelMitwirkungen): self
    {
        if ($this->artikelMitwirkungens->removeElement($artikelMitwirkungen)) {
            // set the owning side to null (unless already changed)
            if ($artikelMitwirkungen->getUser() === $this) {
                $artikelMitwirkungen->setUser(null);
            }
        }

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
            $articel->setAuthor($this);
        }

        return $this;
    }

    public function removeArticel(Articel $articel): self
    {
        if ($this->articels->removeElement($articel)) {
            // set the owning side to null (unless already changed)
            if ($articel->getAuthor() === $this) {
                $articel->setAuthor(null);
            }
        }

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
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPersonen(): ?Personen
    {
        return $this->personen;
    }

    public function setPersonen(?Personen $personen): self
    {
        // unset the owning side of the relation if necessary
        if ($personen === null && $this->personen !== null) {
            $this->personen->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($personen !== null && $personen->getUser() !== $this) {
            $personen->setUser($this);
        }

        $this->personen = $personen;

        return $this;
    }
}
