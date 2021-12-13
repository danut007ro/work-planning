<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversDefaultClass \App\Controller\GetShifts
 */
final class GetShiftsTest extends WebTestCase
{
    public function testGetShifts(): void
    {
        $client = self::createClient();
        $client->request('GET', '/shifts');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertSame(
            '[{"id":1,"name":"0-8","startHour":0,"endHour":8},{"id":2,"name":"8-16","startHour":8,"endHour":16},{"id":3,"name":"16-24","startHour":16,"endHour":24}]',
            $response->getContent(),
        );
    }
}
