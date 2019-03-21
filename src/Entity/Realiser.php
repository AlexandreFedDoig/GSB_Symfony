<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Realiser
 *
 * @ORM\Table(name="realiser", indexes={@ORM\Index(name="AC_NUM", columns={"AC_NUM"}), @ORM\Index(name="VIS_MATRICULE", columns={"VIS_MATRICULE"})})
 * @ORM\Entity
 */
class Realiser
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
     * @var string
     *
     * @ORM\Column(name="VIS_MATRICULE", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $visMatricule;

    /**
     * @var float|null
     *
     * @ORM\Column(name="REA_MTTFRAIS", type="float", precision=10, scale=0, nullable=true)
     */
    private $reaMttfrais;

    public function getAcNum(): ?int
    {
        return $this->acNum;
    }

    public function getVisMatricule(): ?string
    {
        return $this->visMatricule;
    }

    public function getReaMttfrais(): ?float
    {
        return $this->reaMttfrais;
    }

    public function setReaMttfrais(?float $reaMttfrais): self
    {
        $this->reaMttfrais = $reaMttfrais;

        return $this;
    }


}
