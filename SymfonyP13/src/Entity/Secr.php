<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SecrRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SecrRepository::class)
 */
class Secr
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("Secr")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Secr")
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Secr")
     */
    private $Prenom;

    /**
     * @ORM\OneToMany(targetEntity=FichePedagogique::class, mappedBy="Secretaire")
     */
    private $fichePedagogiques;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="secr", cascade={"persist", "remove"})
     */
    private $User;

    public function __construct()
    {
        $this->fichePedagogiques = new ArrayCollection();
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
            $fichePedagogique->setSecretaire($this);
        }

        return $this;
    }

    public function removeFichePedagogique(FichePedagogique $fichePedagogique): self
    {
        if ($this->fichePedagogiques->removeElement($fichePedagogique)) {
            // set the owning side to null (unless already changed)
            if ($fichePedagogique->getSecretaire() === $this) {
                $fichePedagogique->setSecretaire(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
