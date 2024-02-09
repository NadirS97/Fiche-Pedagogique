<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ParcoursRepository::class)
 */
class Parcours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Parcour","Parcours","secr:fiche","ens:fiche"})
     */
    private $Libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Parcour","ue:info","Parcours"})
     */
    private $NiveauParcours;


    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="Parcours")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity=Ue::class, mappedBy="parcours")
     * @Groups({"ue:info","Ues"})
     */
    private $ues;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Parcour","ue:info","Parcours"})
     */
    private $mention;

    public function __construct()
    {
        $this->ue = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
        $this->ues = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
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

    public function getNiveauParcours(): ?string
    {
        return $this->NiveauParcours;
    }

    public function setNiveauParcours(string $NiveauParcours): self
    {
        $this->NiveauParcours = $NiveauParcours;

        return $this;
    }


    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setParcours($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getParcours() === $this) {
                $etudiant->setParcours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ue[]
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(Ue $ue): self
    {
        if (!$this->ues->contains($ue)) {
            $this->ues[] = $ue;
            $ue->setParcours($this);
        }

        return $this;
    }

    public function removeUe(Ue $ue): self
    {
        if ($this->ues->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getParcours() === $this) {
                $ue->setParcours(null);
            }
        }

        return $this;
    }

    public function getMention(): ?string
    {
        return $this->mention;
    }

    public function setMention(string $mention): self
    {
        $this->mention = $mention;

        return $this;
    }

  

    
}
