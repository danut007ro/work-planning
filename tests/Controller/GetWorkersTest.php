<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversDefaultClass \App\Controller\GetWorkers
 */
final class GetWorkersTest extends WebTestCase
{
    public function testGetWorkers(): void
    {
        $client = self::createClient();
        $client->request('GET', '/workers');
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        static::assertSame(
            'application/json',
            $response->headers->get('Content-Type'),
        );
        static::assertSame(
            '[{"id":1,"name":"John Doe"},{"id":2,"name":"Jane Doe"},{"id":3,"name":"Foo Bar"}]',
            $response->getContent(),
        );
    }
}
