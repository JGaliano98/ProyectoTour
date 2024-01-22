<?php

namespace App\Entity;

use App\Repository\TourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: TourRepository::class)]
#[Broadcast]
class Tour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_inicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_fin = null;

    #[ORM\Column]
    private ?int $plazas = null;

    #[ORM\OneToMany(mappedBy: 'id_tour', targetEntity: Reserva::class, orphanRemoval: true)]
    private Collection $reservas;

    #[ORM\ManyToOne(inversedBy: 'tours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ruta $id_ruta = null;

    #[ORM\ManyToOne(inversedBy: 'tours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $id_usuario = null;

    #[ORM\OneToOne(mappedBy: 'id_tour', cascade: ['persist', 'remove'])]
    private ?Informe $informe = null;

    #[ORM\OneToMany(mappedBy: 'id_tour', targetEntity: Valoraciones::class, orphanRemoval: true)]
    private Collection $valoraciones;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
        $this->valoraciones = new ArrayCollection();
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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): static
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): static
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getPlazas(): ?int
    {
        return $this->plazas;
    }

    public function setPlazas(int $plazas): static
    {
        $this->plazas = $plazas;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): static
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas->add($reserva);
            $reserva->setIdTour($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): static
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getIdTour() === $this) {
                $reserva->setIdTour(null);
            }
        }

        return $this;
    }

    public function getIdRuta(): ?ruta
    {
        return $this->id_ruta;
    }

    public function setIdRuta(?ruta $id_ruta): static
    {
        $this->id_ruta = $id_ruta;

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

    public function getInforme(): ?Informe
    {
        return $this->informe;
    }

    public function setInforme(Informe $informe): static
    {
        // set the owning side of the relation if necessary
        if ($informe->getIdTour() !== $this) {
            $informe->setIdTour($this);
        }

        $this->informe = $informe;

        return $this;
    }

    /**
     * @return Collection<int, Valoraciones>
     */
    public function getValoraciones(): Collection
    {
        return $this->valoraciones;
    }

    public function addValoracione(Valoraciones $valoracione): static
    {
        if (!$this->valoraciones->contains($valoracione)) {
            $this->valoraciones->add($valoracione);
            $valoracione->setIdTour($this);
        }

        return $this;
    }

    public function removeValoracione(Valoraciones $valoracione): static
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getIdTour() === $this) {
                $valoracione->setIdTour(null);
            }
        }

        return $this;
    }
}
