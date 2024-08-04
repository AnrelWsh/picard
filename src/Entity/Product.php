<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']]
)]
#[UniqueEntity('Name')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $Price = null;

    #[ORM\Column]
    private ?int $Rate = null;

    #[ORM\Column]
    private ?bool $Available = null;

    /**
     * @var Collection<int, Cart>
     */
    #[ORM\ManyToMany(targetEntity: Cart::class, mappedBy: 'Products')]
    #[Groups('read')]
    private Collection $carts;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->Rate;
    }

    public function setRate(int $Rate): static
    {
        $this->Rate = $Rate;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->Available;
    }

    public function setAvailable(bool $Available): static
    {
        $this->Available = $Available;

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): static
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->addProduct($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            $cart->removeProduct($this);
        }

        return $this;
    }
}
