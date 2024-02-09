<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StatutRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StatutRepository::class)
 */
class Statut
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"statut","newfiche"})
     */
    private $EtudiantRSE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"statut","newfiche"})
     */
    private $EtudiantAJAC;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"statut","newfiche"})
     */
    private $EtudiantRNE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"statut","newfiche"})
     */
    private $EtudiantREDOUBLANT;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"statut","newfiche"})
     */
    private $EtudiantSemestreObtenu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"statut","newfiche"})
     */
    private $EtudiantTiersTemps;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="statuts")
     */
    private $Etudiant;

    /**
     * @ORM\OneToOne(targetEntity=FichePedagogique::class, mappedBy="statut", cascade={"persist", "remove"})
     */
    private $fichePedagogique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtudiantRSE(): ?string
    {
        return $this->EtudiantRSE;
    }

    public function setEtudiantRSE(string $EtudiantRSE): self
    {
        $this->EtudiantRSE = $EtudiantRSE;

        return $this;
    }

    public function getEtudiantAJAC(): ?string
    {
        return $this->EtudiantAJAC;
    }

    public function setEtudiantAJAC(string $EtudiantAJAC): self
    {
        $this->EtudiantAJAC = $EtudiantAJAC;

        return $this;
    }

    public function getEtudiantRNE(): ?string
    {
        return $this->EtudiantRNE;
    }

    public function setEtudiantRNE(?string $EtudiantRNE): self
    {
        $this->EtudiantRNE = $EtudiantRNE;

        return $this;
    }

    public function getEtudiantREDOUBLANT(): ?string
    {
        return $this->EtudiantREDOUBLANT;
    }

    public function setEtudiantREDOUBLANT(?string $EtudiantREDOUBLANT): self
    {
        $this->EtudiantREDOUBLANT = $EtudiantREDOUBLANT;

        return $this;
    }

    public function getEtudiantSemestreObtenu(): ?string
    {
        return $this->EtudiantSemestreObtenu;
    }

    public function setEtudiantSemestreObtenu(?string $EtudiantSemestreObtenu): self
    {
        $this->EtudiantSemestreObtenu = $EtudiantSemestreObtenu;

        return $this;
    }

    public function getEtudiantTiersTemps(): ?string
    {
        return $this->EtudiantTiersTemps;
    }

    public function setEtudiantTiersTemps(?string $EtudiantTiersTemps): self
    {
        $this->EtudiantTiersTemps = $EtudiantTiersTemps;

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

    public function getFichePedagogique(): ?FichePedagogique
    {
        return $this->fichePedagogique;
    }

    public function setFichePedagogique(?FichePedagogique $fichePedagogique): self
    {
        // unset the owning side of the relation if necessary
        if ($fichePedagogique === null && $this->fichePedagogique !== null) {
            $this->fichePedagogique->setStatut(null);
        }

        // set the owning side of the relation if necessary
        if ($fichePedagogique !== null && $fichePedagogique->getStatut() !== $this) {
            $fichePedagogique->setStatut($this);
        }

        $this->fichePedagogique = $fichePedagogique;

        return $this;
    }
}
