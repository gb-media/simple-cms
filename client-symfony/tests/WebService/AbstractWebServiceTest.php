<?php

declare(strict_types=1);

namespace App\Tests\WebService;

use App\WebService\AbstractWebService;
use App\WebService\ResourceException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class AbstractWebServiceTest extends TestCase
{
    public function testShouldThrowExceptionForEmptyDeleteArgument(): void
    {
        $this->expectException(ResourceException::class);
        $this->expectExceptionMessage('[WEB SERVICE] Uuid is required.');
        $this->expectExceptionCode(400);
        $webServiceMock = $this->webServiceMock(400);
        $webServiceMock->delete();
    }

//    public function testGetCollection()
//    {
//
//    }
//
//    public function testGetItem()
//    {
//
//    }
//
//    public function testPost()
//    {
//
//    }
//
//    public function testPut()
//    {
//
//    }

    private function webServiceMock($status, $body = null)
    {
        $mock = new MockHandler([new Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        return new AbstractWebService($client, 'http://mocked.api.xyz/entrypoint/');
    }
}
