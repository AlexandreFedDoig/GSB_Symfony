<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePraticien
 *
 * @ORM\Table(name="type_praticien")
 * @ORM\Entity
 */
class TypePraticien
{
    /**
     * @var string
     *
     * @ORM\Column(name="TYP_CODE", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $typCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TYP_LIBELLE", type="string", length=25, nullable=true)
     */
    private $typLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TYP_LIEU", type="string", length=35, nullable=true)
     */
    private $typLieu;

    public function getTypCode(): ?string
    {
        return $this->typCode;
    }

    public function getTypLibelle(): ?string
    {
        return $this->typLibelle;
    }

    public function setTypLibelle(?string $typLibelle): self
    {
        $this->typLibelle = $typLibelle;

        return $this;
    }

    public function getTypLieu(): ?string
    {
        return $this->typLieu;
    }

    public function setTypLieu(?string $typLieu): self
    {
        $this->typLieu = $typLieu;

        return $this;
    }


}
