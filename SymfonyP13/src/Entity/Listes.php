<?php

namespace App\Entity;

use App\Repository\ListesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListesRepository::class)
 */
class Listes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomListe;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="listes")
     */
    private $Etudiant;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="Liste")
     */
    private $etudiants;

    /**
     * @ORM\ManyToOne(targetEntity=Respo::class, inversedBy="listes")
     */
    private $Responsable;

    public function __construct()
    {
        $this->Etudiant = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomListe(): ?string
    {
        return $this->NomListe;
    }

    public function setNomListe(string $NomListe): self
    {
        $this->NomListe = $NomListe;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiant(): Collection
    {
        return $this->Etudiant;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->Etudiant->contains($etudiant)) {
            $this->Etudiant[] = $etudiant;
            $etudiant->setListe($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->Etudiant->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getListe() === $this) {
                $etudiant->setListe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function getResponsable(): ?Respo
    {
        return $this->Responsable;
    }

    public function setResponsable(?Respo $Responsable): self
    {
        $this->Responsable = $Responsable;

        return $this;
    }
}
