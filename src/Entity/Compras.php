<?php

namespace App\Entity;

use App\Repository\ComprasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComprasRepository::class)]
class Compras
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'compras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clientes $cliente = null;

    #[ORM\ManyToOne(inversedBy: 'compras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Metodos $metodo = null;

    #[ORM\ManyToOne(inversedBy: 'compras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Productos $producto = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Clientes
    {
        return $this->cliente;
    }

    public function setCliente(?Clientes $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getMetodo(): ?Metodos
    {
        return $this->metodo;
    }

    public function setMetodo(?Metodos $metodo): self
    {
        $this->metodo = $metodo;

        return $this;
    }

    public function getProducto(): ?Productos
    {
        return $this->producto;
    }

    public function setProducto(?Productos $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

}
