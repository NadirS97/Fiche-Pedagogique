<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FichePedagogiqueRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FichePedagogiqueRepository::class)
 */
class FichePedagogique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Fiche","secr:fiche","ens:fiche"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Fiche","secr:fiche","ens:fiche"})
     */
    private $Semestre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Fiche","secr:fiche","ens:fiche"})
     */
    private $EtatFiche;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"Fiche","secr:fiche","ens:fiche"})
     */
    private $Date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"Fiche","ens:fiche"})
     */
    private $DateValidation;

    /**
     * @ORM\ManyToOne(targetEntity=Secr::class, inversedBy="fichePedagogiques")
     * @Groups({"Secr","ens:fiche"})
     */
    private $Secretaire;


    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="fichePedagogiques")
     * @Groups({"newfiche","secr:fiche","ens:fiche"})
     */
    private $Etudiant;

    /**
     * @ORM\OneToMany(targetEntity=UeParcours::class, mappedBy="fichePedagogique")
     * @Groups({"UeParcours","newfiche","secr:fiche","ens:fiche"})
     */
    private $UeParcours;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"Fiche"})
     */
    private $transmis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted=false;

    /**
     * @ORM\OneToOne(targetEntity=Statut::class, inversedBy="fichePedagogique", cascade={"persist", "remove"})
     * @Groups({"secr:fiche","ens:fiche"})
     */
    private $statut;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Confirmation=null;

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
        $this->id=$id;
        return $this;
    }

    public function getSemestre(): ?string
    {
        return $this->Semestre;
    }

    public function setSemestre(string $Semestre): self
    {
        $this->Semestre = $Semestre;

        return $this;
    }

    public function getEtatFiche(): ?string
    {
        return $this->EtatFiche;
    }

    public function setEtatFiche(string $EtatFiche): self
    {
        $this->EtatFiche = $EtatFiche;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->DateValidation;
    }

    public function setDateValidation(?\DateTimeInterface $DateValidation): self
    {
        $this->DateValidation = $DateValidation;

        return $this;
    }

    public function getSecretaire(): ?Secr
    {
        return $this->Secretaire;
    }

    public function setSecretaire(?Secr $Secretaire): self
    {
        $this->Secretaire = $Secretaire;

        return $this;
    }


    public function getEtudiant(): ?Etudiant
    {
        return $this->Etudiant;
    }

    public function setEtudiant(?Etudiant $Etudiant): self
    {
        $this->Etudiant = $Etudiant;

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
            $ueParcour->setFichePedagogique($this);
        }

        return $this;
    }

    public function removeUeParcour(UeParcours $ueParcour): self
    {
        if ($this->UeParcours->removeElement($ueParcour)) {
            // set the owning side to null (unless already changed)
            if ($ueParcour->getFichePedagogique() === $this) {
                $ueParcour->setFichePedagogique(null);
            }
        }

        return $this;
    }

    public function getTransmis(): ?bool
    {
        return $this->transmis;
    }

    public function setTransmis(?bool $transmis): self
    {
        $this->transmis = $transmis;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getConfirmation(): ?bool
    {
        return $this->Confirmation;
    }

    public function setConfirmation(?bool $Confirmation): self
    {
        $this->Confirmation = $Confirmation;

        return $this;
    }

}
