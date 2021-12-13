<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversDefaultClass \App\Controller\GetWorkerShifts
 */
final class GetWorkerShiftsTest extends WebTestCase
{
    public function testGetWorkerShiftsWithoutDateFilter(): void
    {
        $client = self::createClient();
        $client->request('GET', '/worker/3/shifts');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertSame(
            '[{"id":3,"shift":{"id":2,"name":"8-16"},"date":"2021-01-01T00:00:00+00:00"},{"id":4,"shift":{"id":1,"name":"0-8"},"date":"2021-01-02T00:00:00+00:00"}]',
            $response->getContent(),
        );
    }

    public function testGetWorkerShiftsWithDateFilter(): void
    {
        $client = self::createClient();
        $client->request('GET', '/worker/3/shifts?date=2021-01-02');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertSame(
            '[{"id":4,"shift":{"id":1,"name":"0-8"},"date":"2021-01-02T00:00:00+00:00"}]',
            $response->getContent(),
        );
    }
}
