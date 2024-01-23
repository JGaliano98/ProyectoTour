<?php

namespace App\Entity;

use App\Repository\RutaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: RutaRepository::class)]
#[Broadcast]
class Ruta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    #[ORM\ManyToOne(inversedBy: 'rutas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $id_usuario = null;

    #[ORM\OneToMany(mappedBy: 'id_ruta', targetEntity: Tour::class, orphanRemoval: true)]
    private Collection $tours;

    #[ORM\ManyToOne(inversedBy: 'rutas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Localidad $id_localidad = null;

    #[ORM\ManyToMany(targetEntity: Item::class, mappedBy: 'id_ruta')]
    private Collection $items;

    #[ORM\ManyToMany(targetEntity: item::class, inversedBy: 'Rutas')]
    private Collection $id_item;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->id_item = new ArrayCollection();
    }






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function getIdUsuario(): ?usuario
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(?usuario $id_usuario): static
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * @return Collection<int, Tour>
     */
    public function getTours(): Collection
    {
        return $this->tours;
    }

    public function addTour(Tour $tour): static
    {
        if (!$this->tours->contains($tour)) {
            $this->tours->add($tour);
            $tour->setIdRuta($this);
        }

        return $this;
    }

    public function removeTour(Tour $tour): static
    {
        if ($this->tours->removeElement($tour)) {
            // set the owning side to null (unless already changed)
            if ($tour->getIdRuta() === $this) {
                $tour->setIdRuta(null);
            }
        }

        return $this;
    }

    public function getIdLocalidad(): ?Localidad
    {
        return $this->id_localidad;
    }

    public function setIdLocalidad(?Localidad $id_localidad): static
    {
        $this->id_localidad = $id_localidad;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->addIdRutum($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            $item->removeIdRutum($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, item>
     */
    public function getIdItem(): Collection
    {
        return $this->id_item;
    }

    public function addIdItem(item $idItem): static
    {
        if (!$this->id_item->contains($idItem)) {
            $this->id_item->add($idItem);
        }

        return $this;
    }

    public function removeIdItem(item $idItem): static
    {
        $this->id_item->removeElement($idItem);

        return $this;
    }



}
