<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Shift;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShiftFixtures extends Fixture
{
    public const SHIFT_0_8 = 'shift_0_8';
    public const SHIFT_8_16 = 'shift_8_16';
    public const SHIFT_16_24 = 'shift_16_24';

    public function load(ObjectManager $manager): void
    {
        $shift0 = (new Shift())
            ->setName('0-8')
            ->setStartHour(0)
            ->setEndHour(8)
        ;

        $shift1 = (new Shift())
            ->setName('8-16')
            ->setStartHour(8)
            ->setEndHour(16)
        ;

        $shift2 = (new Shift())
            ->setName('16-24')
            ->setStartHour(16)
            ->setEndHour(24)
        ;

        $manager->persist($shift0);
        $manager->persist($shift1);
        $manager->persist($shift2);

        $manager->flush();

        $this->addReference(self::SHIFT_0_8, $shift0);
        $this->addReference(self::SHIFT_8_16, $shift1);
        $this->addReference(self::SHIFT_16_24, $shift2);
    }
}
