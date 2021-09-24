<?php

namespace App\Entity;

use App\Repository\BiciklRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BiciklRepository::class)
 */
class Bicikl
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
    private $tip;

    /**
     * @ORM\Column(type="integer")
     */
    private $brojPutnika;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marka", inversedBy="bicikl")
     */
    private $marka;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTip(): ?string
    {
        return $this->tip;
    }

    public function setTip(string $tip): self
    {
        $this->tip = $tip;

        return $this;
    }

    public function getBrojPutnika(): ?int
    {
        return $this->brojPutnika;
    }

    public function setBrojPutnika(int $brojPutnika): self
    {
        $this->brojPutnika = $brojPutnika;

        return $this;
    }

    public function getMarka(): ?Marka
    {
        return $this->marka;
    }

    public function setMarka(?Marka $marka): self
    {
        $this->marka = $marka;

        return $this;
    }
}
