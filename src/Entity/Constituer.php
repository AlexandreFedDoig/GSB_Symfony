<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constituer
 *
 * @ORM\Table(name="constituer", indexes={@ORM\Index(name="MED_DEPOTLEGAL", columns={"MED_DEPOTLEGAL"}), @ORM\Index(name="CMP_CODE", columns={"CMP_CODE"})})
 * @ORM\Entity
 */
class Constituer
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
     * @ORM\Column(name="CMP_CODE", type="string", length=4, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $cmpCode;

    /**
     * @var float|null
     *
     * @ORM\Column(name="CST_QTE", type="float", precision=10, scale=0, nullable=true)
     */
    private $cstQte;

    public function getMedDepotlegal(): ?string
    {
        return $this->medDepotlegal;
    }

    public function getCmpCode(): ?string
    {
        return $this->cmpCode;
    }

    public function getCstQte(): ?float
    {
        return $this->cstQte;
    }

    public function setCstQte(?float $cstQte): self
    {
        $this->cstQte = $cstQte;

        return $this;
    }


}
