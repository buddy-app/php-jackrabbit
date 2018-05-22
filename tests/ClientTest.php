<?php

namespace Jackrabbit\Tests;

use Exception;
use Jackrabbit\Client;
use Jackrabbit\Tests\Spies\AMQPChannelSpy;
use Jackrabbit\Tests\Spies\AMQPConnectionBridgeFactorySpy;
use Jackrabbit\Tests\Spies\AMQPConnectionBridgeSpy;
use PhpAmqpLib\Message\AMQPMessage;
use PHPUnit\Framework\TestCase;

/**
 * Tests of client
 */
class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var AMQPChannelSpy
     */
    private $channelSpy;

    /**
     * @var AMQPConnectionBridgeFactorySpy
     */
    private $connectionBridgeFactorySpy;

    /**
     * @var AMQPConnectionBridgeSpy
     */
    private $connectionBridgeSpy;

    /**
     * @throws Exception
     */
    public function setUp()
    {
        $this->channelSpy = new AMQPChannelSpy();
        $this->connectionBridgeSpy = new AMQPConnectionBridgeSpy($this->channelSpy);
        $this->connectionBridgeFactorySpy = new AMQPConnectionBridgeFactorySpy($this->connectionBridgeSpy);
        $this->client = new Client($this->connectionBridgeFactorySpy);
    }

    public function testClientCallsConnectionBridgeFactory()
    {
        $this->assertSame(1, $this->connectionBridgeFactorySpy->getNumberOfBuildCalls());
    }

    public function testClientReturnsLastMethodFromClientCall()
    {
        $this->client->fooBarBaz();
        $this->assertSame('fooBarBaz', $this->client->getLastMethod());
    }

    public function testClientCallsChannelFromConnectionBridgeOnClientCall()
    {
        $this->client->fooBarBaz();
        $this->assertSame(1, $this->connectionBridgeSpy->getNumberOfChannelCalls());
    }

    public function testClientCallsBasicPublishOnChannelOnClientCall()
    {
        $this->client->fooBarrr();
        $this->assertEquals(
            [
                'basic_publish' => [
                    new AMQPMessage(null),
                    'fooBarrr',
                    '',
                    false,
                    false,
                    null
                ]
            ],
            $this->channelSpy->getCalls()
        );
    }

    public function testClientCallsBasicPublishWithArgumentsAsJsonObjectOnClientCall()
    {
        $arguments = [
            'bar' => 'bar',
            'baz' => 'baz'
        ];
        $this->client->foo($arguments);

        $this->assertEquals(
            [
                'basic_publish' => [
                    new AMQPMessage(json_encode($arguments)),
                    'foo',
                    '',
                    false,
                    false,
                    null
                ]
            ],
            $this->channelSpy->getCalls()
        );
    }
}
