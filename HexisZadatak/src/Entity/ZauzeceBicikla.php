<?php

namespace App\Entity;

use App\Repository\ZauzeceBiciklaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZauzeceBiciklaRepository::class)
 */
class ZauzeceBicikla
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datumZauzeca;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $period;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datumIsteka;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bicikl", inversedBy="zauzece")
     */
    private $bicikl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatumZauzeca(): ?\DateTimeInterface
    {
        return $this->datumZauzeca;
    }

    public function setDatumZauzeca(\DateTimeInterface $datumZauzeca): self
    {
        $this->datumZauzeca = $datumZauzeca;

        return $this;
    }

    public function getPeriod(): ?\DateInterval
    {
        return $this->period;
    }

    public function setPeriod(\DateInterval $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getDatumIsteka(): ?\DateTimeInterface
    {
        return $this->datumIsteka;
    }

    public function setDatumIsteka(\DateTimeInterface $datumIsteka): self
    {
        $this->datumIsteka = $datumIsteka;

        return $this;
    }

    public function getBicikl(): ?Bicikl
    {
        return $this->bicikl;
    }

    public function setBicikl(?Bicikl $bicikl): self
    {
        $this->bicikl = $bicikl;

        return $this;
    }
}
