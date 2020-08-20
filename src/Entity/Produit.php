<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var
     * @ORM\Column(type="string", length=128, unique=true, nullable=true)
     * @Gedmo\Slug (fields={"Titre", "DateCreated"}, updatable=false, dateFormat="d/m/Y")
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixTTC;

    /**
     * @ORM\Column(type="float")
     * @Assert\Regex("/^[0-9]{2,}[.]?[0-9]*$/")
     */
    private $Poids;

    /**
     * @ORM\Column(type="integer")
     */
    private $Couleur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateCreated;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min="3", max="100", notInRangeMessage="Mettez un nombre de pieces entre {{ min }} et {{ max }} pièces")
     */
    private $StockQte;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $Actif;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="Produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="Produits", cascade={"persist", "remove"})
     */
    private $stock;

    public function __construct()
    {
        $this->Actif = false;
        $this->setDateCreated(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrixTTC(): ?float
    {
        return $this->PrixTTC;
    }

    public function setPrixTTC(float $PrixTTC): self
    {
        $this->PrixTTC = $PrixTTC;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->Poids;
    }

    public function setPoids(float $Poids): self
    {
        $this->Poids = $Poids;

        return $this;
    }

    public function getCouleur(): ?int
    {
        return $this->Couleur;
    }

    public function setCouleur(int $Couleur): self
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->DateCreated;
    }

    public function setDateCreated(\DateTimeInterface $DateCreated): self
    {
        $this->DateCreated = $DateCreated;

        return $this;
    }

    public function getStockQte(): ?int
    {
        return $this->StockQte;
    }

    public function setStockQte(int $StockQte): self
    {
        $this->StockQte = $StockQte;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->Actif;
    }

    public function setActif(bool $Actif): self
    {
        $this->Actif = $Actif;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    const COULEUR = [
        1 => 'Blanc',
        2 => 'Noir',
        3 => 'Rose',
        4 => 'Rouge',
        5 => 'Bleu',
        6 => 'Vert',
        7 => 'Marron',
        8 => 'Jaune',
        9 => 'Violet',
        10 => 'Orange',
    ];

    public function getCouleurType(){
        return self::COULEUR[$this->getCouleur()];
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(Stock $stock): self
    {
        $this->stock = $stock;

        // set the owning side of the relation if necessary
        if ($stock->getProduits() !== $this) {
            $stock->setProduits($this);
        }

        return $this;
    }
}
