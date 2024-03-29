<?php

namespace App\Entity;

use App\Repository\ValoracionesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ValoracionesRepository::class)]
#[Broadcast]
class Valoraciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $estrellas = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comentario = null;

    #[ORM\OneToOne(inversedBy: 'valoraciones', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?reserva $id_reserva = null;

    #[ORM\ManyToOne(inversedBy: 'valoraciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?tour $id_tour = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstrellas(): ?int
    {
        return $this->estrellas;
    }

    public function setEstrellas(int $estrellas): static
    {
        $this->estrellas = $estrellas;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): static
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getIdReserva(): ?reserva
    {
        return $this->id_reserva;
    }

    public function setIdReserva(reserva $id_reserva): static
    {
        $this->id_reserva = $id_reserva;

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
}
