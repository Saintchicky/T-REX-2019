<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VaisseauRepository")
 */
class Vaisseau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $a;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $b;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): ?int
    {
        return $this->a;
    }

    public function setA(?int $a): self
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?int
    {
        return $this->b;
    }

    public function setB(?int $b): self
    {
        $this->b = $b;

        return $this;
    }
}
