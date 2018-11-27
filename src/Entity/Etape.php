<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapeRepository")
 */
class Etape
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numeroEtape;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $villeEtape;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nombreJours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Circuit", inversedBy="etapes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $circuit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroEtape(): ?int
    {
        return $this->numeroEtape;
    }

    public function setNumeroEtape(int $numeroEtape): self
    {
        $this->numeroEtape = $numeroEtape;

        return $this;
    }

    public function getVilleEtape(): ?string
    {
        return $this->villeEtape;
    }

    public function setVilleEtape(string $villeEtape): self
    {
        $this->villeEtape = $villeEtape;

        return $this;
    }

    public function getNombreJours(): ?int
    {
        return $this->nombreJours;
    }

    public function setNombreJours(int $nombreJours): self
    {
        $this->nombreJours = $nombreJours;

        return $this;
    }

    public function getCircuit(): ?Circuit
    {
        return $this->circuit;
    }

    public function setCircuit(?Circuit $circuit): self
    {
        $this->circuit = $circuit;

        return $this;
    }
}
