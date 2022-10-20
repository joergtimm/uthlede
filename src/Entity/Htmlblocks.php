<?php

namespace App\Entity;

use App\Repository\HtmlblocksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HtmlblocksRepository::class)
 */
class Htmlblocks
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
    private $art;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url1art;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url2art;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url3art;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $text1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mb;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createAt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getUrl1(): ?string
    {
        return $this->url1;
    }

    public function setUrl1(?string $url1): self
    {
        $this->url1 = $url1;

        return $this;
    }

    public function getUrl1art(): ?string
    {
        return $this->url1art;
    }

    public function setUrl1art(?string $url1art): self
    {
        $this->url1art = $url1art;

        return $this;
    }

    public function getUrl2(): ?string
    {
        return $this->url2;
    }

    public function setUrl2(?string $url2): self
    {
        $this->url2 = $url2;

        return $this;
    }

    public function getUrl2art(): ?string
    {
        return $this->url2art;
    }

    public function setUrl2art(?string $url2art): self
    {
        $this->url2art = $url2art;

        return $this;
    }

    public function getUrl3(): ?string
    {
        return $this->url3;
    }

    public function setUrl3(?string $url3): self
    {
        $this->url3 = $url3;

        return $this;
    }

    public function getUrl3art(): ?string
    {
        return $this->url3art;
    }

    public function setUrl3art(?string $url3art): self
    {
        $this->url3art = $url3art;

        return $this;
    }

    public function getText1(): ?string
    {
        return $this->text1;
    }

    public function setText1(?string $text1): self
    {
        $this->text1 = $text1;

        return $this;
    }

    public function getText2(): ?string
    {
        return $this->text2;
    }

    public function setText2(?string $text2): self
    {
        $this->text2 = $text2;

        return $this;
    }

    public function getMt(): ?int
    {
        return $this->mt;
    }

    public function setMt(?int $mt): self
    {
        $this->mt = $mt;

        return $this;
    }

    public function getMb(): ?int
    {
        return $this->mb;
    }

    public function setMb(?int $mb): self
    {
        $this->mb = $mb;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }
}
