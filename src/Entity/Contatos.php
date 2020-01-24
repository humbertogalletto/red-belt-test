<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContatosRepository")
 */
class Contatos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nome;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $Telefone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->Nome;
    }

    public function setNome(string $Nome): self
    {
        $this->Nome = $Nome;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->Telefone;
    }

    public function setTelefone(string $Telefone): self
    {
        $this->Telefone = $Telefone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }
}
