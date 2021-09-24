<?php

namespace App\Entity;

use App\Repository\MarkaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarkaRepository::class)
 */
class Marka
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
    private $naziv;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bicikl", mappedBy="marka")
     */
    private $bicikl;

    public function __construct()
    {
        $this->bicikl = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaziv(): ?string
    {
        return $this->naziv;
    }

    public function setNaziv(string $naziv): self
    {
        $this->naziv = $naziv;

        return $this;
    }

    /**
     * @return Collection|Bicikl[]
     */
    public function getBicikl(): Collection
    {
        return $this->bicikl;
    }

    public function addBicikl(Bicikl $bicikl): self
    {
        if (!$this->bicikl->contains($bicikl)) {
            $this->bicikl[] = $bicikl;
            $bicikl->setMarka($this);
        }

        return $this;
    }

    public function removeBicikl(Bicikl $bicikl): self
    {
        if ($this->bicikl->removeElement($bicikl)) {
            // set the owning side to null (unless already changed)
            if ($bicikl->getMarka() === $this) {
                $bicikl->setMarka(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->naziv;
    }
}
