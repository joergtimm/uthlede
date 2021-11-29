<?php

namespace App\Entity;

use App\Repository\TankstellenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TankstellenRepository::class)
 */
class Tankstellen
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
    private $tid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lng;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $diesel;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $e5;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $e10;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isOpen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $houseNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postCode;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updateAt;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $openingTimes = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $overrides = [];

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $wholeDay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTid(): ?string
    {
        return $this->tid;
    }

    public function setTid(string $tid): self
    {
        $this->tid = $tid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getDiesel(): ?float
    {
        return $this->diesel;
    }

    public function setDiesel(?float $diesel): self
    {
        $this->diesel = $diesel;

        return $this;
    }

    public function getE5(): ?float
    {
        return $this->e5;
    }

    public function setE5(?float $e5): self
    {
        $this->e5 = $e5;

        return $this;
    }

    public function getE10(): ?float
    {
        return $this->e10;
    }

    public function setE10(?float $e10): self
    {
        $this->e10 = $e10;

        return $this;
    }

    public function getIsOpen(): ?bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(?bool $isOpen): self
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(?string $houseNumber): self
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getOpeningTimes(): ?array
    {
        return $this->openingTimes;
    }

    public function setOpeningTimes(?array $openingTimes): self
    {
        $this->openingTimes = $openingTimes;

        return $this;
    }

    public function getOverrides(): ?array
    {
        return $this->overrides;
    }

    public function setOverrides(?array $overrides): self
    {
        $this->overrides = $overrides;

        return $this;
    }

    public function getWholeDay(): ?bool
    {
        return $this->wholeDay;
    }

    public function setWholeDay(?bool $wholeDay): self
    {
        $this->wholeDay = $wholeDay;

        return $this;
    }
}
