<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
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
    private $Vorname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nachname;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $KD;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, cascade={"persist", "remove"})
     */
    private $FK_Team_ID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVorname(): ?string
    {
        return $this->Vorname;
    }

    public function setVorname(string $Vorname): self
    {
        $this->Vorname = $Vorname;

        return $this;
    }

    public function getNachname(): ?string
    {
        return $this->Nachname;
    }

    public function setNachname(string $Nachname): self
    {
        $this->Nachname = $Nachname;

        return $this;
    }

    public function getKD(): ?float
    {
        return $this->KD;
    }

    public function setKD(?float $KD): self
    {
        $this->KD = $KD;

        return $this;
    }

    public function getFKTeamID(): ?Team
    {
        return $this->FK_Team_ID;
    }

    public function setFKTeamID(?Team $FK_Team_ID): self
    {
        $this->FK_Team_ID = $FK_Team_ID;

        return $this;
    }
}
