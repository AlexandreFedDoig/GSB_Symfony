<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Travailler
 *
 * @ORM\Table(name="travailler", indexes={@ORM\Index(name="REG_CODE", columns={"REG_CODE"}), @ORM\Index(name="VIS_MATRICULE", columns={"VIS_MATRICULE"})})
 * @ORM\Entity
 */
class Travailler
{
    /**
     * @var string
     *
     * @ORM\Column(name="VIS_MATRICULE", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $visMatricule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="JJMMAA", type="datetime", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $jjmmaa;

    /**
     * @var string
     *
     * @ORM\Column(name="REG_CODE", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $regCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TRA_ROLE", type="string", length=11, nullable=true)
     */
    private $traRole;

    public function getVisMatricule(): ?string
    {
        return $this->visMatricule;
    }

    public function getJjmmaa(): ?\DateTimeInterface
    {
        return $this->jjmmaa;
    }

    public function getRegCode(): ?string
    {
        return $this->regCode;
    }

    public function getTraRole(): ?string
    {
        return $this->traRole;
    }

    public function setTraRole(?string $traRole): self
    {
        $this->traRole = $traRole;

        return $this;
    }


}
