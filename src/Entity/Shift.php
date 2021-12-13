<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ShiftRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShiftRepository::class)]
class Shift
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name = '';

    #[ORM\Column]
    private int $startHour = 0;

    #[ORM\Column]
    private int $endHour = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartHour(): int
    {
        return $this->startHour;
    }

    public function setStartHour(int $startHour): self
    {
        $this->startHour = $startHour;

        return $this;
    }

    public function getEndHour(): int
    {
        return $this->endHour;
    }

    public function setEndHour(int $endHour): self
    {
        $this->endHour = $endHour;

        return $this;
    }
}
