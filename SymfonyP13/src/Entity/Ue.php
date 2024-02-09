<?php

namespace App\Entity;

use App\Entity\Parcours;
use App\Repository\UeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UeRepository::class)
 */
class Ue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Ue","newfiche","Ues"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Ue","secr:fiche","Ues"})
     */
    private $CodeApogee;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Ue","secr:fiche","Ues"})
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Ue","secr:fiche","Ues"})
     */
    private $Libelle;

    /**
     * @ORM\OneToMany(targetEntity=UeParcours::class, mappedBy="ue")
     */
    private $UeParcours;

    /**
     * @ORM\ManyToOne(targetEntity=Parcours::class, inversedBy="ues")
     * @Groups({"Parcours"})
     */
    private $parcours;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"Ue","secr:fiche","Ues"})
     */
    private $ECTS;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Ue","secr:fiche","Ues"})
     */
    private $Semestre;

    public function __construct()
    {
        $this->UeParcours = new ArrayCollection();
    }


  

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCodeApogee(): ?string
    {
        return $this->CodeApogee;
    }

    public function setCodeApogee(string $CodeApogee): self
    {
        $this->CodeApogee = $CodeApogee;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }


    /**
     * @return Collection|UeParcours[]
     */
    public function getUeParcours(): Collection
    {
        return $this->UeParcours;
    }

    public function addUeParcour(UeParcours $ueParcour): self
    {
        if (!$this->UeParcours->contains($ueParcour)) {
            $this->UeParcours[] = $ueParcour;
            $ueParcour->setUe($this);
        }

        return $this;
    }

    public function removeUeParcour(UeParcours $ueParcour): self
    {
        if ($this->UeParcours->removeElement($ueParcour)) {
            // set the owning side to null (unless already changed)
            if ($ueParcour->getUe() === $this) {
                $ueParcour->setUe(null);
            }
        }

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): self
    {
        $this->parcours = $parcours;

        return $this;
    }

    public function getECTS(): ?int
    {
        return $this->ECTS;
    }

    public function setECTS(?int $ECTS): self
    {
        $this->ECTS = $ECTS;

        return $this;
    }

    public function getSemestre(): ?string
    {
        return $this->Semestre;
    }

    public function setSemestre(?string $Semestre): self
    {
        $this->Semestre = $Semestre;

        return $this;
    }

  
   
}
