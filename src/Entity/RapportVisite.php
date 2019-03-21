<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RapportVisite
 *
 * @ORM\Table(name="rapport_visite", indexes={@ORM\Index(name="PRA_NUM", columns={"PRA_NUM"}), @ORM\Index(name="VIS_MATRICULE", columns={"VIS_MATRICULE"})})
 * @ORM\Entity
 */
class RapportVisite
{
    /**
     * @var string
     *
     * @ORM\Column(name="VIS_MATRICULE", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $visMatricule;

    /**
     * @var int
     *
     * @ORM\Column(name="RAP_NUM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $rapNum;

    /**
     * @var int
     *
     * @ORM\Column(name="PRA_NUM", type="integer", nullable=false)
     */
    private $praNum;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="RAP_DATE", type="datetime", nullable=true)
     */
    private $rapDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RAP_BILAN", type="string", length=255, nullable=true)
     */
    private $rapBilan;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RAP_MOTIF", type="string", length=255, nullable=true)
     */
    private $rapMotif;

    public function getVisMatricule(): ?string
    {
        return $this->visMatricule;
    }

    public function getRapNum(): ?int
    {
        return $this->rapNum;
    }

    public function getPraNum(): ?int
    {
        return $this->praNum;
    }

    public function setPraNum(int $praNum): self
    {
        $this->praNum = $praNum;

        return $this;
    }

    public function getRapDate(): ?\DateTimeInterface
    {
        return $this->rapDate;
    }

    public function setRapDate(?\DateTimeInterface $rapDate): self
    {
        $this->rapDate = $rapDate;

        return $this;
    }

    public function getRapBilan(): ?string
    {
        return $this->rapBilan;
    }

    public function setRapBilan(?string $rapBilan): self
    {
        $this->rapBilan = $rapBilan;

        return $this;
    }

    public function getRapMotif(): ?string
    {
        return $this->rapMotif;
    }

    public function setRapMotif(?string $rapMotif): self
    {
        $this->rapMotif = $rapMotif;

        return $this;
    }


}
