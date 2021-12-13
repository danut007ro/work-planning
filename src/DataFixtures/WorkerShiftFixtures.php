<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\WorkerShift;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkerShiftFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $workerShift0 = (new WorkerShift())
            ->setWorker($this->getReference(WorkerFixtures::WORKER_JOHN)) // @phpstan-ignore-line
            ->setShift($this->getReference(ShiftFixtures::SHIFT_0_8)) // @phpstan-ignore-line
            ->setDate(new \DateTimeImmutable('2021-01-01'))
        ;

        $workerShift1 = (new WorkerShift())
            ->setWorker($this->getReference(WorkerFixtures::WORKER_JANE)) // @phpstan-ignore-line
            ->setShift($this->getReference(ShiftFixtures::SHIFT_8_16)) // @phpstan-ignore-line
            ->setDate(new \DateTimeImmutable('2021-01-01'))
        ;

        $workerShift2 = (new WorkerShift())
            ->setWorker($this->getReference(WorkerFixtures::WORKER_FOO)) // @phpstan-ignore-line
            ->setShift($this->getReference(ShiftFixtures::SHIFT_8_16)) // @phpstan-ignore-line
            ->setDate(new \DateTimeImmutable('2021-01-01'))
        ;

        $workerShift3 = (new WorkerShift())
            ->setWorker($this->getReference(WorkerFixtures::WORKER_FOO)) // @phpstan-ignore-line
            ->setShift($this->getReference(ShiftFixtures::SHIFT_0_8)) // @phpstan-ignore-line
            ->setDate(new \DateTimeImmutable('2021-01-02'))
        ;

        $manager->persist($workerShift0);
        $manager->persist($workerShift1);
        $manager->persist($workerShift2);
        $manager->persist($workerShift3);

        $manager->flush();
    }
}
