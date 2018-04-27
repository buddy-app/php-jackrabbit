<?php

namespace Jackrabbit\Tests;

use Jackrabbit\Bridges\AMQPConnectionBridge;
use Jackrabbit\Entities\ConnectionParameters;
use Jackrabbit\Factories\AMQPConnectionBridgeFactory;
use PHPUnit\Framework\TestCase;

/**
 * Tests of amqp connection bridge factory
 */
class AMQPConnectionBridgeFactoryTest extends TestCase
{
    const HOST = '::1';
    const PASSWORD = 'Doe';
    const PORT = '1234';
    const USER = 'John';

    /**
     * @var ConnectionParameters
     */
    private $connectionParameters;

    /**
     * @var AMQPConnectionBridgeFactory
     */
    private $factory;

    public function setUp()
    {
        $this->connectionParameters = new ConnectionParameters();
        $this->connectionParameters->host = static::HOST;
        $this->connectionParameters->password = static::PASSWORD;
        $this->connectionParameters->port = static::PORT;
        $this->connectionParameters->user = static::USER;

        $this->factory = new AMQPConnectionBridgeFactory($this->connectionParameters);
    }

    public function testFactoryReturnsAnInstanceOfAMQPConnectionBridge(){
        $this->assertInstanceOf(
            AMQPConnectionBridge::class,
            $this->factory->build()
        );
    }

    public function testFactoryAppliesConnectionParametersOnNewInstance()
    {
        $connectionBridge = $this->factory->build();
        $this->assertSame(static::HOST, $connectionBridge->getHost());
        $this->assertSame(static::PASSWORD, $connectionBridge->getPassword());
        $this->assertSame(static::PORT, $connectionBridge->getPort());
        $this->assertSame(static::USER, $connectionBridge->getUser());
    }
}
