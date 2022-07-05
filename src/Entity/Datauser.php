<?php

namespace App\Entity;

use App\Repository\DatauserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DatauserRepository::class)]
class Datauser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $login;

    #[ORM\Column(type: 'string', length: 255)]
    private $pass;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }
}
