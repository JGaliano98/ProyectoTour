<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
#[Broadcast]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?usuario $id_usuario = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?tour $id_tour = null;

    #[ORM\OneToOne(mappedBy: 'id_reserva', cascade: ['persist', 'remove'])]
    private ?Valoraciones $valoraciones = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

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

    public function getIdTour(): ?tour
    {
        return $this->id_tour;
    }

    public function setIdTour(?tour $id_tour): static
    {
        $this->id_tour = $id_tour;

        return $this;
    }

    public function getValoraciones(): ?Valoraciones
    {
        return $this->valoraciones;
    }

    public function setValoraciones(Valoraciones $valoraciones): static
    {
        // set the owning side of the relation if necessary
        if ($valoraciones->getIdReserva() !== $this) {
            $valoraciones->setIdReserva($this);
        }

        $this->valoraciones = $valoraciones;

        return $this;
    }
}
