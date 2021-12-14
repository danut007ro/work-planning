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
    public function testGetWorkerShifts(): void
    {
        $client = self::createClient();
        $client->request('GET', '/worker-shifts');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertSame(
            '[{"id":1,"worker":{"id":1,"name":"John Doe"},"shift":{"id":1,"name":"0-8"},"date":"2021-01-01T00:00:00+00:00"},{"id":2,"worker":{"id":2,"name":"Jane Doe"},"shift":{"id":2,"name":"8-16"},"date":"2021-01-01T00:00:00+00:00"},{"id":3,"worker":{"id":3,"name":"Foo Bar"},"shift":{"id":2,"name":"8-16"},"date":"2021-01-01T00:00:00+00:00"},{"id":4,"worker":{"id":3,"name":"Foo Bar"},"shift":{"id":1,"name":"0-8"},"date":"2021-01-02T00:00:00+00:00"}]',
            $response->getContent(),
        );
    }

    public function testGetWorkerShiftsWithWorkerFilter(): void
    {
        $client = self::createClient();
        $client->request('GET', '/worker-shifts?worker=3');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertSame(
            '[{"id":3,"worker":{"id":3,"name":"Foo Bar"},"shift":{"id":2,"name":"8-16"},"date":"2021-01-01T00:00:00+00:00"},{"id":4,"worker":{"id":3,"name":"Foo Bar"},"shift":{"id":1,"name":"0-8"},"date":"2021-01-02T00:00:00+00:00"}]',
            $response->getContent(),
        );
    }

    public function testGetWorkerShiftsWithDateFilter(): void
    {
        $client = self::createClient();
        $client->request('GET', '/worker-shifts?date=2021-01-02');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertSame(
            '[{"id":4,"worker":{"id":3,"name":"Foo Bar"},"shift":{"id":1,"name":"0-8"},"date":"2021-01-02T00:00:00+00:00"}]',
            $response->getContent(),
        );
    }
}
