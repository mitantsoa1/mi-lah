<?php

namespace App\Entity;

use App\Repository\FonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FonctionRepository::class)]
class Fonction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(length: 200)]
    private ?string $description = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'fonction')]
    private Collection $agence;

    #[ORM\Column(length: 20)]
    private ?string $code = null;

    /**
     * @var Collection<int, Operation>
     */
    #[ORM\OneToMany(targetEntity: Operation::class, mappedBy: 'fonction')]
    private Collection $operations;

    public function __construct()
    {
        $this->agence = new ArrayCollection();
        $this->operations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAgence(): Collection
    {
        return $this->agence;
    }

    public function addAgence(User $agence): static
    {
        if (!$this->agence->contains($agence)) {
            $this->agence->add($agence);
            $agence->setFonction($this);
        }

        return $this;
    }

    public function removeAgence(User $agence): static
    {
        if ($this->agence->removeElement($agence)) {
            // set the owning side to null (unless already changed)
            if ($agence->getFonction() === $this) {
                $agence->setFonction(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

    /**
     * @return Collection<int, Operation>
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): static
    {
        if (!$this->operations->contains($operation)) {
            $this->operations->add($operation);
            $operation->setFonction($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): static
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getFonction() === $this) {
                $operation->setFonction(null);
            }
        }

        return $this;
    }
}