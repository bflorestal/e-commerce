<?php

namespace App\Entity;

use App\Repository\ContenuPanierRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContenuPanierRepository::class)]
class ContenuPanier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private $Quantite;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank]
    private $date;

    #[ORM\ManyToOne(targetEntity: Panier::class, inversedBy: 'ContenuPanier')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $panier;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'Produits')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private $produit;

    public function __construct()
    {
        // Renseigne automatiquement la date
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
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

    public function getPanier(): ?panier
    {
        return $this->panier;
    }

    public function setPanier(?panier $panier): self
    {
        $this->panier = $panier;

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
}
