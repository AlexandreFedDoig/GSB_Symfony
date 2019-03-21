<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posseder
 *
 * @ORM\Table(name="posseder", indexes={@ORM\Index(name="PRA_NUM", columns={"PRA_NUM"}), @ORM\Index(name="SPE_CODE", columns={"SPE_CODE"})})
 * @ORM\Entity
 */
class Posseder
{
    /**
     * @var int
     *
     * @ORM\Column(name="PRA_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $praNum;

    /**
     * @var string
     *
     * @ORM\Column(name="SPE_CODE", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $speCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="POS_DIPLOME", type="string", length=10, nullable=true)
     */
    private $posDiplome;

    /**
     * @var float|null
     *
     * @ORM\Column(name="POS_COEFPRESCRIPTION", type="float", precision=10, scale=0, nullable=true)
     */
    private $posCoefprescription;

    public function getPraNum(): ?int
    {
        return $this->praNum;
    }

    public function getSpeCode(): ?string
    {
        return $this->speCode;
    }

    public function getPosDiplome(): ?string
    {
        return $this->posDiplome;
    }

    public function setPosDiplome(?string $posDiplome): self
    {
        $this->posDiplome = $posDiplome;

        return $this;
    }

    public function getPosCoefprescription(): ?float
    {
        return $this->posCoefprescription;
    }

    public function setPosCoefprescription(?float $posCoefprescription): self
    {
        $this->posCoefprescription = $posCoefprescription;

        return $this;
    }


}
