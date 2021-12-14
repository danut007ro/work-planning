<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Repository\WorkerShiftRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversDefaultClass \App\Controller\DeleteWorkerShifts
 */
final class DeleteWorkerShiftsTest extends WebTestCase
{
    public function testDeleteWorkerShifts(): void
    {
        $client = self::createClient();
        $client->request('DELETE', '/worker-shifts/1');

        $this->assertResponseIsSuccessful();
        static::assertNull(
            static::getContainer()->get(WorkerShiftRepository::class)->find(1),
        );
    }
}
