<?php

namespace App\Entity;

use App\Repository\ZauzeceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZauzeceRepository::class)
 */
class Zauzece
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="dateinterval")
     */
    private $period;

    public function getId(): ?int
    {
        return $this->id;
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
}
