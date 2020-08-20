<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Magasin")
     */
    private $magasin;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Produit")
     */
    private  $produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $Qte;




    public function getQte(): ?int
    {
        return $this->Qte;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setQte(int $Qte): self
    {
        $this->Qte = $Qte;

        return $this;
    }

    public function setMagasin(Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }

    public function setProduit(Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
