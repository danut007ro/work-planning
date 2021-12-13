<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\WorkerShiftRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: WorkerShiftRepository::class)]
#[ORM\UniqueConstraint(fields: ['date', 'worker'])]
class WorkerShift
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_worker_shifts'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Worker::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Worker $worker;

    #[ORM\ManyToOne(targetEntity: Shift::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_worker_shifts'])]
    private Shift $shift;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['get_worker_shifts'])]
    private \DateTimeImmutable $date;

    public function __construct()
    {
        $this->worker = new Worker();
        $this->shift = new Shift();
        $this->date = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorker(): Worker
    {
        return $this->worker;
    }

    public function setWorker(Worker $worker): self
    {
        $this->worker = $worker;

        return $this;
    }

    public function getShift(): Shift
    {
        return $this->shift;
    }

    public function setShift(Shift $shift): self
    {
        $this->shift = $shift;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = \DateTimeImmutable::createFromInterface($date);

        return $this;
    }
}
