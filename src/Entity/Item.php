<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[Broadcast]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $geolocalizacion = null;

    #[ORM\ManyToMany(targetEntity: Ruta::class, mappedBy: 'ruta')]
    private Collection $rutas;

    #[ORM\ManyToMany(targetEntity: Ruta::class, mappedBy: 'id_item')]
    private Collection $P;

    #[ORM\ManyToMany(targetEntity: ruta::class, inversedBy: 'items')]
    private Collection $id_ruta;

    #[ORM\ManyToMany(targetEntity: Ruta::class, mappedBy: 'id_item')]
    private Collection $Rutas;

    public function __construct()
    {
        $this->rutas = new ArrayCollection();
        $this->P = new ArrayCollection();
        $this->id_ruta = new ArrayCollection();
        $this->Rutas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

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

    public function getGeolocalizacion(): ?string
    {
        return $this->geolocalizacion;
    }

    public function setGeolocalizacion(?string $geolocalizacion): static
    {
        $this->geolocalizacion = $geolocalizacion;

        return $this;
    }

    /**
     * @return Collection<int, Ruta>
     */
    public function getRutas(): Collection
    {
        return $this->rutas;
    }

    public function addRuta(Ruta $ruta): static
    {
        if (!$this->rutas->contains($ruta)) {
            $this->rutas->add($ruta);
            $ruta->addRutum($this);
        }

        return $this;
    }

    public function removeRuta(Ruta $ruta): static
    {
        if ($this->rutas->removeElement($ruta)) {
            $ruta->removeRutum($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Ruta>
     */
    public function getP(): Collection
    {
        return $this->P;
    }

    public function addP(Ruta $p): static
    {
        if (!$this->P->contains($p)) {
            $this->P->add($p);
            $p->addIdItem($this);
        }

        return $this;
    }

    public function removeP(Ruta $p): static
    {
        if ($this->P->removeElement($p)) {
            $p->removeIdItem($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ruta>
     */
    public function getIdRuta(): Collection
    {
        return $this->id_ruta;
    }

    public function addIdRutum(ruta $idRutum): static
    {
        if (!$this->id_ruta->contains($idRutum)) {
            $this->id_ruta->add($idRutum);
        }

        return $this;
    }

    public function removeIdRutum(ruta $idRutum): static
    {
        $this->id_ruta->removeElement($idRutum);

        return $this;
    }
}
