<?php

declare(strict_types=1);

namespace App\Request;

use App\Entity\Shift;
use App\Entity\Worker;
use Symfony\Component\Validator\Constraints\NotNull;

final class PostWorkerShiftsRequest
{
    #[NotNull]
    public Worker $worker;

    #[NotNull]
    public Shift $shift;

    #[NotNull]
    public ?\DateTimeImmutable $date;
}
