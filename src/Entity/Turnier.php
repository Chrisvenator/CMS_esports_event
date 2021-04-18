<?php

namespace App\Entity;

use App\Repository\TurnierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TurnierRepository::class)
 */
class Turnier
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
    private $Game;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $FK_Team1_ID;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $FK_Team2_ID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Price;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $StartingTime;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, cascade={"persist", "remove"})
     */
    private $FK_Winner_ID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?string
    {
        return $this->Game;
    }

    public function setGame(string $Game): self
    {
        $this->Game = $Game;

        return $this;
    }

    public function getFKTeam1ID(): ?Team
    {
        return $this->FK_Team1_ID;
    }

    public function setFKTeam1ID(Team $FK_Team1_ID): self
    {
        $this->FK_Team1_ID = $FK_Team1_ID;

        return $this;
    }

    public function getFKTeam2ID(): ?Team
    {
        return $this->FK_Team2_ID;
    }

    public function setFKTeam2ID(Team $FK_Team2_ID): self
    {
        $this->FK_Team2_ID = $FK_Team2_ID;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getStartingTime(): ?\DateTimeInterface
    {
        return $this->StartingTime;
    }

    public function setStartingTime(?\DateTimeInterface $StartingTime): self
    {
        $this->StartingTime = $StartingTime;

        return $this;
    }

    public function getFKWinnerID(): ?Team
    {
        return $this->FK_Winner_ID;
    }

    public function setFKWinnerID(?Team $FK_Winner_ID): self
    {
        $this->FK_Winner_ID = $FK_Winner_ID;

        return $this;
    }
}
