<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversDefaultClass \App\Controller\PostWorkerShifts
 */
final class PostWorkerShiftsTest extends WebTestCase
{
    public function testPostWorkerShifts(): void
    {
        $client = self::createClient();
        $client->request('POST', '/worker-shifts', [], [], [], json_encode([
            'worker' => 1,
            'shift' => 2,
            'date' => '2022-01-01',
        ]));
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertStringContainsString(
            ',"worker":{"id":1,"name":"John Doe"},"shift":{"id":2,"name":"8-16"},"date":"2022-01-01T00:00:00+00:00"}',
            $response->getContent(),
        );
    }

    public function testPostWorkerShiftsInvalid(): void
    {
        $client = self::createClient();
        $client->request('POST', '/worker-shifts');

        $this->assertResponseIsUnprocessable();
    }

    public function testPostWorkerShiftsAlreadyExisting(): void
    {
        $client = self::createClient();
        $client->request('POST', '/worker-shifts', [], [], [], json_encode([
            'worker' => 1,
            'shift' => 2,
            'date' => '2021-01-01',
        ]));

        $this->assertResponseIsUnprocessable();
    }
}
