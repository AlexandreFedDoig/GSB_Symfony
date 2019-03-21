<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inviter
 *
 * @ORM\Table(name="inviter", indexes={@ORM\Index(name="AC_NUM", columns={"AC_NUM"}), @ORM\Index(name="PRA_NUM", columns={"PRA_NUM"})})
 * @ORM\Entity
 */
class Inviter
{
    /**
     * @var int
     *
     * @ORM\Column(name="AC_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $acNum;

    /**
     * @var int
     *
     * @ORM\Column(name="PRA_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $praNum;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="SPECIALISTEON", type="boolean", nullable=true)
     */
    private $specialisteon;

    public function getAcNum(): ?int
    {
        return $this->acNum;
    }

    public function getPraNum(): ?int
    {
        return $this->praNum;
    }

    public function getSpecialisteon(): ?bool
    {
        return $this->specialisteon;
    }

    public function setSpecialisteon(?bool $specialisteon): self
    {
        $this->specialisteon = $specialisteon;

        return $this;
    }


}
