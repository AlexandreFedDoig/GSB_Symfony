<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composant
 *
 * @ORM\Table(name="composant")
 * @ORM\Entity
 */
class Composant
{
    /**
     * @var string
     *
     * @ORM\Column(name="CMP_CODE", type="string", length=4, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cmpCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CMP_LIBELLE", type="string", length=25, nullable=true)
     */
    private $cmpLibelle;

    public function getCmpCode(): ?string
    {
        return $this->cmpCode;
    }

    public function getCmpLibelle(): ?string
    {
        return $this->cmpLibelle;
    }

    public function setCmpLibelle(?string $cmpLibelle): self
    {
        $this->cmpLibelle = $cmpLibelle;

        return $this;
    }


}
