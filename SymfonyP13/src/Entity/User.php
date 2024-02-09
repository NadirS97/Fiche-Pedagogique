<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"User"})
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"User"})
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"User"})
     */
    private $Role;

    /**
     * @ORM\OneToOne(targetEntity=Etudiant::class, mappedBy="UserAcc", cascade={"persist", "remove"})
     * @Groups({"UserEtu"})
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity=Respo::class, mappedBy="Respo", cascade={"persist", "remove"})
     */
    private $respo;

    /**
     * @ORM\OneToOne(targetEntity=Secr::class, mappedBy="User", cascade={"persist", "remove"})
     */
    private $secr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): self
    {
        $this->Role = $Role;

        return $this;
    }
    public function getSalt(){}
    public function eraseCredentials(){}

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        // unset the owning side of the relation if necessary
        if ($etudiant === null && $this->etudiant !== null) {
            $this->etudiant->setUserAcc(null);
        }

        // set the owning side of the relation if necessary
        if ($etudiant !== null && $etudiant->getUserAcc() !== $this) {
            $etudiant->setUserAcc($this);
        }

        $this->etudiant = $etudiant;

        return $this;
    }

    public function getRespo(): ?Respo
    {
        return $this->respo;
    }

    public function setRespo(?Respo $respo): self
    {
        // unset the owning side of the relation if necessary
        if ($respo === null && $this->respo !== null) {
            $this->respo->setRespo(null);
        }

        // set the owning side of the relation if necessary
        if ($respo !== null && $respo->getRespo() !== $this) {
            $respo->setRespo($this);
        }

        $this->respo = $respo;

        return $this;
    }

    public function getSecr(): ?Secr
    {
        return $this->secr;
    }

    public function setSecr(?Secr $secr): self
    {
        // unset the owning side of the relation if necessary
        if ($secr === null && $this->secr !== null) {
            $this->secr->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($secr !== null && $secr->getUser() !== $this) {
            $secr->setUser($this);
        }

        $this->secr = $secr;

        return $this;
    }

}
