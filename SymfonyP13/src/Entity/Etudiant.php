<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class) 
 */
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Etu"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"Etu","NumEtu","newfiche","profile","secr:fiche","ens:fiche"})
     */
    private $NumEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Etu","profile","secr:fiche","ens:fiche"})
     */
    private $PrenomEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Etu","profile","secr:fiche","ens:fiche"})
     */
    private $NomEtudiant;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"Etu","profile"})
     */
    private $DateNaissance;

    /**
     * @ORM\Column(type="text")
     * @Groups({"profile"})
     */
    private $AdresseEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profile"})
     */
    private $TelEtudiant;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profile","secr:fiche","ens:fiche"})
     */
    private $EmailEtudiant;

    /**
     * @ORM\Column(type="text")
     */
    private $AdresseParents;


    /**
     * @ORM\OneToMany(targetEntity=FichePedagogique::class, mappedBy="Etudiant")
     * @Groups({"Etu"})
     */
    private $fichePedagogiques;

    /**
     * @ORM\OneToMany(targetEntity=Statut::class, mappedBy="Etudiant")
     * @Groups({"Etu","statut","newfiche"})
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Listes::class, inversedBy="etudiants")
     */
    private $Liste;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="etudiant", cascade={"persist", "remove"})
     */
    private $UserAcc;

    /**
     * @ORM\ManyToOne(targetEntity=Parcours::class, inversedBy="etudiants")
     * @Groups({"Parcours","secr:fiche","ens:fiche"})
     */
    private $Parcours;

    public function __construct()
    {
        $this->fichePedagogiques = new ArrayCollection();
        $this->statut = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    private $NVPassword;

    public function getNVPassword()
    {
        return $this->NVPassword;

    }
    public function setNVPassword(string $NVPassword): self
    {
        $this->NVPassword = $NVPassword;

        return $this;

    }

    public function getNumEtudiant(): ?int
    {
        return $this->NumEtudiant; 
    }

    public function setNumEtudiant(int $NumEtudiant): self
    {
        $this->NumEtudiant = $NumEtudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->PrenomEtudiant;
    }

    public function setPrenomEtudiant(string $PrenomEtudiant): self
    {
        $this->PrenomEtudiant = $PrenomEtudiant;

        return $this;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->NomEtudiant;
    }

    public function setNomEtudiant(string $NomEtudiant): self
    {
        $this->NomEtudiant = $NomEtudiant;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): self
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getAdresseEtudiant(): ?string
    {
        return $this->AdresseEtudiant;
    }

    public function setAdresseEtudiant(string $AdresseEtudiant): self
    {
        $this->AdresseEtudiant = $AdresseEtudiant;

        return $this;
    }

    public function getTelEtudiant(): ?string
    {
        return $this->TelEtudiant;
    }

    public function setTelEtudiant(string $TelEtudiant): self
    {
        $this->TelEtudiant = $TelEtudiant;

        return $this;
    }

    public function getEmailEtudiant(): ?string
    {
        return $this->EmailEtudiant;
    }

    public function setEmailEtudiant(string $EmailEtudiant): self
    {
        $this->EmailEtudiant = $EmailEtudiant;

        return $this;
    }

    public function getAdresseParents(): ?string
    {
        return $this->AdresseParents;
    }

    public function setAdresseParents(string $AdresseParents): self
    {
        $this->AdresseParents = $AdresseParents;

        return $this;
    }


    /**
     * @return Collection|FichePedagogique[]
     */
    public function getFichePedagogiques(): Collection
    {
        return $this->fichePedagogiques;
    }

    public function addFichePedagogique(FichePedagogique $fichePedagogique): self
    {
        if (!$this->fichePedagogiques->contains($fichePedagogique)) {
            $this->fichePedagogiques[] = $fichePedagogique;
            $fichePedagogique->setEtudiant($this);
        }

        return $this;
    }

    public function removeFichePedagogique(FichePedagogique $fichePedagogique): self
    {
        if ($this->fichePedagogiques->removeElement($fichePedagogique)) {
            // set the owning side to null (unless already changed)
            if ($fichePedagogique->getEtudiant() === $this) {
                $fichePedagogique->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Statut[]
     */
    public function getStatut(): Collection
    {
        return $this->statut;
    }

    public function addStatut(Statut $statut): self
    {
        if (!$this->statut->contains($statut)) {
            $this->statut[] = $statut;
            $statut->setEtudiant($this);
        }

        return $this;
    }

    public function removeStatut(Statut $statut): self
    {
        if ($this->statuts->removeElement($statut)) {
            // set the owning side to null (unless already changed)
            if ($statut->getEtudiant() === $this) {
                $statut->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getListe(): ?Listes
    {
        return $this->Liste;
    }

    public function setListe(?Listes $Liste): self
    {
        $this->Liste = $Liste;

        return $this;
    }

    public function getUserAcc(): ?User
    {
        return $this->UserAcc;
    }

    public function setUserAcc(?User $UserAcc): self
    {
        $this->UserAcc = $UserAcc;

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->Parcours;
    }

    public function setParcours(?Parcours $Parcours): self
    {
        $this->Parcours = $Parcours;

        return $this;
    }
}
