<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formuler
 *
 * @ORM\Table(name="formuler", indexes={@ORM\Index(name="MED_DEPOTLEGAL", columns={"MED_DEPOTLEGAL"}), @ORM\Index(name="PRE_CODE", columns={"PRE_CODE"})})
 * @ORM\Entity
 */
class Formuler
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
     * @ORM\Column(name="PRE_CODE", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $preCode;

    public function getMedDepotlegal(): ?string
    {
        return $this->medDepotlegal;
    }

    public function getPreCode(): ?string
    {
        return $this->preCode;
    }


}
