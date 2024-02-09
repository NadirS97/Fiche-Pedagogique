<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UeParcoursRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UeParcoursRepository::class)
 */
class UeParcours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ens:fiche"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"UeParcours","secr:fiche","ens:fiche"})
     */
    private $AnneeParcours;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"UeParcours","newfiche","secr:fiche","ens:fiche"})
     */
    private $RSE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"UeParcours","ens:fiche","validationRSE"})
     */
    private $ValidationRSE=null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"UeParcours","newfiche","secr:fiche","ens:fiche"})
     */
    private $Inscription;

    /**
     * @ORM\Column(type="float")
     * @Groups({"UeParcours","newfiche","secr:fiche","ens:fiche"})
     */
    private $VNote;

    /**
     * @ORM\ManyToOne(targetEntity=Ue::class, inversedBy="UeParcours")
     * @Groups({"Ue","newfiche","secr:fiche","ens:fiche"})
     */
    private $ue;

    /**
     * @ORM\ManyToOne(targetEntity=FichePedagogique::class, inversedBy="UeParcours")
     */
    private $fichePedagogique;





    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function setId(int $id): self
    {
        $this->id=$id;
        return $this;
    }

    public function getAnneeParcours(): ?int
    {
        return $this->AnneeParcours;
    }

    public function setAnneeParcours(int $AnneeParcours): self
    {
        $this->AnneeParcours = $AnneeParcours;

        return $this;
    }


    public function getRSE(): ?string
    {
        return $this->RSE;
    }

    public function setRSE(string $RSE): self
    {
        $this->RSE = $RSE;

        return $this;
    }

    public function getValidationRSE(): ?string
    {
        return $this->ValidationRSE;
    }

    public function setValidationRSE(string $ValidationRSE): self
    {
        $this->ValidationRSE = $ValidationRSE;

        return $this;
    }

    public function getInscription(): ?string
    {
        return $this->Inscription;
    }

    public function setInscription(string $Inscription): self
    {
        $this->Inscription = $Inscription;

        return $this;
    }

    public function getVNote(): ?float
    {
        return $this->VNote;
    }

    public function setVNote(float $VNote): self
    {
        $this->VNote = $VNote;

        return $this;
    }

    public function getUe(): ?Ue
    {
        return $this->ue;
    }

    public function setUe(?Ue $ue): self
    {
        $this->ue = $ue;

        return $this;
    }

    public function getFichePedagogique(): ?FichePedagogique
    {
        return $this->fichePedagogique;
    }

    public function setFichePedagogique(?FichePedagogique $fichePedagogique): self
    {
        $this->fichePedagogique = $fichePedagogique;

        return $this;
    }


  
}
