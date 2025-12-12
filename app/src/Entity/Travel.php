<?php

namespace App\Entity;

use App\Repository\TravelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelRepository::class)]
class Travel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    public ?\DateTime $dateDepart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateArrive = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $timeDepart = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $timeArrive = null;

    #[ORM\Column(length: 255)]
    public ?string $placeDepart = null;

    #[ORM\Column(length: 255)]
    public ?string $placeArrive = null;

    #[ORM\Column(length: 50)]
    private ?string $statu = null;

    #[ORM\Column]
    public ?int $nbPlaces = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $car = null;

    public $page = 1;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'travels')]
    private Collection $user;

    #[ORM\ManyToOne(inversedBy: 'travel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    
    public function __construct()
    {
        $this->user = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTime
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTime $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrive(): ?\DateTime
    {
        return $this->dateArrive;
    }

    public function setDateArrive(\DateTime $dateArrive): static
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    public function getTimeDepart(): ?\DateTime
    {
        return $this->timeDepart;
    }

    public function setTimeDepart(\DateTime $timeDepart): static
    {
        $this->timeDepart = $timeDepart;

        return $this;
    }

    public function getTimeArrive(): ?\DateTime
    {
        return $this->timeArrive;
    }

    public function setTimeArrive(\DateTime $timeArrive): static
    {
        $this->timeArrive = $timeArrive;

        return $this;
    }

    public function getPlaceDepart(): ?string
    {
        return $this->placeDepart;
    }

    public function setPlaceDepart(string $placeDepart): static
    {
        $this->placeDepart = $placeDepart;

        return $this;
    }

    public function getPlaceArrive(): ?string
    {
        return $this->placeArrive;
    }

    public function setPlaceArrive(string $placeArrive): static
    {
        $this->placeArrive = $placeArrive;

        return $this;
    }

    public function getStatu(): ?string
    {
        return $this->statu;
    }

    public function setStatu(string $statu): static
    {
        $this->statu = $statu;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->addTravel($this);
            $this->setNbPlaces($this->nbPlaces - 1);

        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->user->removeElement($user);
        $user->removeTravel($this);

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }





    public function getDepartureDateTime(): \DateTime
{
    return new \DateTime(
        $this->dateDepart->format('Y-m-d') . ' ' .
        $this->timeDepart->format('H:i:s')
    );
}

public function getArrivalDateTime(): \DateTime
{
    return new \DateTime(
        $this->dateArrive->format('Y-m-d') . ' ' .
        $this->timeArrive->format('H:i:s')
    );
}



public function getDurationInMinutes(): int
{
    $start = $this->getDepartureDateTime();
    $end   = $this->getArrivalDateTime();

    return ($end->getTimestamp() - $start->getTimestamp()) / 60;
}


public function getDurationInHours(): float
{
    return round($this->getDurationInMinutes() / 60, 2);
}



}
