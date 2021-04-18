<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $Passwort;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Rechte;

    public function getId(): ?int {
        return $this->id;
    }

    public function getEmail(): ?string {
        return $this->Email;
    }

    public function setEmail(string $Email): self {
        $this->Email = $Email;

        return $this;
    }

    public function getPasswort(): ?string {
        return $this->Passwort;
    }

    public function setPasswort(string $Passwort): self {
        $this->Passwort = password_hash($Passwort);

        return $this;
    }

    public function getRechte(): ?int {
        return $this->Rechte;
    }

    public function setRechte(?int $Rechte): self {
        $this->Rechte = $Rechte;

        return $this;
    }
}
