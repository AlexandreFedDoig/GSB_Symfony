<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prescrire
 *
 * @ORM\Table(name="prescrire", indexes={@ORM\Index(name="TIN_CODE", columns={"TIN_CODE"}), @ORM\Index(name="MED_DEPOTLEGAL", columns={"MED_DEPOTLEGAL"}), @ORM\Index(name="DOS_CODE", columns={"DOS_CODE"})})
 * @ORM\Entity
 */
class Prescrire
{
    /**
     * @var string
     *
     * @ORM\Column(name="MED_DEPOTLEGAL", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $medDepotlegal;

    /**
     * @var string
     *
     * @ORM\Column(name="TIN_CODE", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tinCode;

    /**
     * @var string
     *
     * @ORM\Column(name="DOS_CODE", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dosCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRE_POSOLOGIE", type="string", length=40, nullable=true)
     */
    private $prePosologie;

    public function getMedDepotlegal(): ?string
    {
        return $this->medDepotlegal;
    }

    public function getTinCode(): ?string
    {
        return $this->tinCode;
    }

    public function getDosCode(): ?string
    {
        return $this->dosCode;
    }

    public function getPrePosologie(): ?string
    {
        return $this->prePosologie;
    }

    public function setPrePosologie(?string $prePosologie): self
    {
        $this->prePosologie = $prePosologie;

        return $this;
    }


}
