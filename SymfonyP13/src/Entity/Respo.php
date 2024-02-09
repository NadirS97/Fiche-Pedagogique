<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RespoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RespoRepository::class)
 */
class Respo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("Resp")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Resp")
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Resp")
     */
    private $Prenom;

    /**
     * @ORM\OneToMany(targetEntity=Listes::class, mappedBy="Responsable")
     */
    private $listes;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="respo", cascade={"persist", "remove"})
     */
    private $Respo;

    public function __construct()
    {
        $this->listes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    /**
     * @return Collection|Listes[]
     */
    public function getListes(): Collection
    {
        return $this->listes;
    }

    public function addListe(Listes $liste): self
    {
        if (!$this->listes->contains($liste)) {
            $this->listes[] = $liste;
            $liste->setResponsable($this);
        }

        return $this;
    }

    public function removeListe(Listes $liste): self
    {
        if ($this->listes->removeElement($liste)) {
            // set the owning side to null (unless already changed)
            if ($liste->getResponsable() === $this) {
                $liste->setResponsable(null);
            }
        }

        return $this;
    }

    public function getRespo(): ?User
    {
        return $this->Respo;
    }

    public function setRespo(?User $Respo): self
    {
        $this->Respo = $Respo;

        return $this;
    }
}
