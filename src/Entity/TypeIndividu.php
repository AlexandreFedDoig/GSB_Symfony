<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeIndividu
 *
 * @ORM\Table(name="type_individu", indexes={@ORM\Index(name="TIN_CODE", columns={"TIN_CODE"})})
 * @ORM\Entity
 */
class TypeIndividu
{
    /**
     * @var string
     *
     * @ORM\Column(name="TIN_CODE", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tinCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TIN_LIBELLE", type="string", length=50, nullable=true)
     */
    private $tinLibelle;

    public function getTinCode(): ?string
    {
        return $this->tinCode;
    }

    public function getTinLibelle(): ?string
    {
        return $this->tinLibelle;
    }

    public function setTinLibelle(?string $tinLibelle): self
    {
        $this->tinLibelle = $tinLibelle;

        return $this;
    }


}
