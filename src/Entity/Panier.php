<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\Column(type: 'boolean')]
    private $etat;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'panier')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'float')]
    private $montant;

    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'Produit')]
    #[ORM\JoinColumn(nullable: false)]
    private $produit;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: ContenuPanier::class, orphanRemoval: true)]
    private $ContenuPanier;

    public function __construct()
    {
        $this->etat = false;
        $this->ContenuPanier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    public function setProduit(?produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * @return Collection<int, ContenuPanier>
     */
    public function getContenuPanier(): Collection
    {
        return $this->ContenuPanier;
    }

    public function addContenuPanier(ContenuPanier $contenupanier): self
    {
        if (!$this->ContenuPanier->contains($contenupanier)) {
            $this->ContenuPanier[] = $contenupanier;
            $contenupanier->setPanier($this);
        }

        return $this;
    }

    public function removeContenuPanier(ContenuPanier $contenupanier): self
    {
        if ($this->ContenuPanier->removeElement($contenupanier)) {
            // set the owning side to null (unless already changed)
            if ($contenupanier->getPanier() === $this) {
                $contenupanier->setPanier(null);
            }
        }

        return $this;
    }

    // Retourne l'id pour les jointures
    public function __toString(){
        return $this->id;
    }
}
