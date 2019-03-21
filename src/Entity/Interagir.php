<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interagir
 *
 * @ORM\Table(name="interagir", indexes={@ORM\Index(name="MED_MED_PERTURBE", columns={"MED_MED_PERTURBE"}), @ORM\Index(name="MED_PERTURBATEUR", columns={"MED_PERTURBATEUR"})})
 * @ORM\Entity
 */
class Interagir
{
    /**
     * @var string
     *
     * @ORM\Column(name="MED_PERTURBATEUR", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $medPerturbateur;

    /**
     * @var string
     *
     * @ORM\Column(name="MED_MED_PERTURBE", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $medMedPerturbe;

    public function getMedPerturbateur(): ?string
    {
        return $this->medPerturbateur;
    }

    public function getMedMedPerturbe(): ?string
    {
        return $this->medMedPerturbe;
    }


}
