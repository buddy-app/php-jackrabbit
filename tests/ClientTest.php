<?php

namespace Jackrabbit\Tests;

use Jackrabbit\Client;
use Jackrabbit\Tests\Spies\AMQPConnectionBridgeFactorySpy;
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
     * @var AMQPConnectionBridgeFactorySpy
     */
    private $connectionBridgeFactorySpy;

    public function setUp()
    {
        $this->connectionBridgeFactorySpy = new AMQPConnectionBridgeFactorySpy();
        $this->client = new Client($this->connectionBridgeFactorySpy);
    }

    public function testClientCallsConnectionBridgeFactory(){
        $this->assertSame(1, $this->connectionBridgeFactorySpy->getNumberOfBuildCalls());
    }
}
