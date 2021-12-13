<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkerFixtures extends Fixture
{
    public const WORKER_0_8 = 'worker_0_8';
    public const WORKER_8_16_0 = 'worker_8_16_0';
    public const WORKER_8_16_1 = 'worker_8_16_1';
    public const WORKER_16_24 = 'worker_16_24';

    public function load(ObjectManager $manager): void
    {
        $worker0 = (new Worker())
            ->setName('John Doe')
        ;

        $worker1 = (new Worker())
            ->setName('Jane Doe')
        ;

        $worker2 = (new Worker())
            ->setName('Foo Bar')
        ;

        $worker3 = (new Worker())
            ->setName('Foo Bar-Chu')
        ;

        $manager->persist($worker0);
        $manager->persist($worker1);
        $manager->persist($worker2);
        $manager->persist($worker3);

        $manager->flush();

        $this->addReference(self::WORKER_0_8, $worker0);
        $this->addReference(self::WORKER_8_16_0, $worker1);
        $this->addReference(self::WORKER_8_16_1, $worker2);
        $this->addReference(self::WORKER_16_24, $worker3);
    }
}
