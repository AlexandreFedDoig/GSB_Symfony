<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dosage
 *
 * @ORM\Table(name="dosage")
 * @ORM\Entity
 */
class Dosage
{
    /**
     * @var string
     *
     * @ORM\Column(name="DOS_CODE", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dosCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DOS_QUANTITE", type="string", length=10, nullable=true)
     */
    private $dosQuantite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DOS_UNITE", type="string", length=10, nullable=true)
     */
    private $dosUnite;

    public function getDosCode(): ?string
    {
        return $this->dosCode;
    }

    public function getDosQuantite(): ?string
    {
        return $this->dosQuantite;
    }

    public function setDosQuantite(?string $dosQuantite): self
    {
        $this->dosQuantite = $dosQuantite;

        return $this;
    }

    public function getDosUnite(): ?string
    {
        return $this->dosUnite;
    }

    public function setDosUnite(?string $dosUnite): self
    {
        $this->dosUnite = $dosUnite;

        return $this;
    }


}
