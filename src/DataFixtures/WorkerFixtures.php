<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkerFixtures extends Fixture
{
    public const WORKER_JOHN = 'worker_john';
    public const WORKER_JANE = 'worker_jane';
    public const WORKER_FOO = 'worker_foo';

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

        $manager->persist($worker0);
        $manager->persist($worker1);
        $manager->persist($worker2);

        $manager->flush();

        $this->addReference(self::WORKER_JOHN, $worker0);
        $this->addReference(self::WORKER_JANE, $worker1);
        $this->addReference(self::WORKER_FOO, $worker2);
    }
}
