<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Labo
 *
 * @ORM\Table(name="labo")
 * @ORM\Entity
 */
class Labo
{
    /**
     * @var string
     *
     * @ORM\Column(name="LAB_CODE", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LAB_NOM", type="string", length=10, nullable=true)
     */
    private $labNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LAB_CHEFVENTE", type="string", length=20, nullable=true)
     */
    private $labChefvente;

    public function getLabCode(): ?string
    {
        return $this->labCode;
    }

    public function getLabNom(): ?string
    {
        return $this->labNom;
    }

    public function setLabNom(?string $labNom): self
    {
        $this->labNom = $labNom;

        return $this;
    }

    public function getLabChefvente(): ?string
    {
        return $this->labChefvente;
    }

    public function setLabChefvente(?string $labChefvente): self
    {
        $this->labChefvente = $labChefvente;

        return $this;
    }


}
