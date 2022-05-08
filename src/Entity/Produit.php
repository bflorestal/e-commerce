<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[UniqueEntity('nom')]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $nom;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private $prix;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private $stock;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Panier::class)]
    #[Assert\NotBlank]
    private $Produit;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: ContenuPanier::class, orphanRemoval: true)]
    #[Assert\NotBlank]
    private $Produits;

    public function __construct()
    {
        $this->Produit = new ArrayCollection();
        $this->Produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(Panier $produit): self
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit[] = $produit;
            $produit->setProduit($this);
        }

        return $this;
    }

    public function removeProduit(Panier $produit): self
    {
        if ($this->Produit->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getProduit() === $this) {
                $produit->setProduit(null);
            }
        }

        return $this;
    }

    // Retourne le nom du produit et la description
    public function __toString(){
        return $this->nom." : ".$this->description;
    }

    /**
     * @return Collection<int, ContenuPanier>
     */
    public function getProduits(): Collection
    {
        return $this->Produits;
    }
}
