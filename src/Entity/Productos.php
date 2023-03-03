<?php

namespace App\Entity;

use App\Repository\ProductosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductosRepository::class)]
class Productos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $precio = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Flores $tipo_flores = null;

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

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getTipoFlores(): ?Flores
    {
        return $this->tipo_flores;
    }

    public function setTipoFlores(?Flores $tipo_flores): self
    {
        $this->tipo_flores = $tipo_flores;

        return $this;
    }
    public function __toString()
    {
        return $this->getTipo();
    }

}
