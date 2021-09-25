<?php

namespace App\Entity;

use App\Repository\RomobilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RomobilRepository::class)
 */
class Romobil
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
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marka", inversedBy="romobil")
     */
    private $marka;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Zauzece", mappedBy="romobil")
     */
    private $zauzece;

    public function __construct()
    {
        $this->zauzece = new ArrayCollection();
    }

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

    /**
     * @return Collection|Zauzece[]
     */
    public function getZauzece(): Collection
    {
        return $this->zauzece;
    }

    public function addZauzece(Zauzece $zauzece): self
    {
        if (!$this->zauzece->contains($zauzece)) {
            $this->zauzece[] = $zauzece;
            $zauzece->setRomobil($this);
        }

        return $this;
    }

    public function removeZauzece(Zauzece $zauzece): self
    {
        if ($this->zauzece->removeElement($zauzece)) {
            // set the owning side to null (unless already changed)
            if ($zauzece->getRomobil() === $this) {
                $zauzece->setRomobil(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->tip;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
