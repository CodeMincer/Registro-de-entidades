<?php

namespace App\Entity;

use App\Repository\MetodosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetodosRepository::class)]
class Metodos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\OneToMany(mappedBy: 'metodo', targetEntity: Compras::class)]
    private Collection $compras;

    public function __construct()
    {
        $this->compras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
    
    public function __toString()
    {
        return $this->getTipo();
    }

    /**
     * @return Collection<int, Compras>
     */
    public function getCompras(): Collection
    {
        return $this->compras;
    }

    public function addCompra(Compras $compra): self
    {
        if (!$this->compras->contains($compra)) {
            $this->compras->add($compra);
            $compra->setMetodo($this);
        }

        return $this;
    }

    public function removeCompra(Compras $compra): self
    {
        if ($this->compras->removeElement($compra)) {
            // set the owning side to null (unless already changed)
            if ($compra->getMetodo() === $this) {
                $compra->setMetodo(null);
            }
        }

        return $this;
    }
}
