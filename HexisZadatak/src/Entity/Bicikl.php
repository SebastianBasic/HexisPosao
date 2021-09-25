<?php

namespace App\Entity;

use App\Repository\BiciklRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ZauzeceBicikla", mappedBy="bicikl")
     */
    private $zauzece;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

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
     * @return Collection|ZauzeceBicikla[]
     */
    public function getZauzece(): Collection
    {
        return $this->zauzece;
    }

    public function addZauzece(ZauzeceBicikla $zauzece): self
    {
        if (!$this->zauzece->contains($zauzece)) {
            $this->zauzece[] = $zauzece;
            $zauzece->setBicikl($this);
        }

        return $this;
    }

    public function removeZauzece(ZauzeceBicikla $zauzece): self
    {
        if ($this->zauzece->removeElement($zauzece)) {
            // set the owning side to null (unless already changed)
            if ($zauzece->getBicikl() === $this) {
                $zauzece->setBicikl(null);
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
