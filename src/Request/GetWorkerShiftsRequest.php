<?php

declare(strict_types=1);

namespace App\Request;

use App\Entity\Worker;

final class GetWorkerShiftsRequest
{
    public ?Worker $worker = null;
    public ?\DateTimeImmutable $date = null;
}
