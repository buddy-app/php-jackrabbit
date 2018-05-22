<?php

namespace Jackrabbit\Tests;

use Jackrabbit\Bridges\AMQPConnectionBridge;
use Jackrabbit\Entities\ConnectionParameters;
use Jackrabbit\Factories\AMQPConnectionBridgeFactory;
use Jackrabbit\Tests\Spies\AMQPConnectionFactorySpy;
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
     * @var AMQPConnectionFactorySpy
     */
    private $connectionFactorySpy;

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

        $this->connectionFactorySpy = new AMQPConnectionFactorySpy($this->connectionParameters);
        $this->factory = new AMQPConnectionBridgeFactory($this->connectionFactorySpy);
    }

    public function testFactoryReturnsAnInstanceOfAMQPConnectionBridge()
    {
        $this->assertInstanceOf(
            AMQPConnectionBridge::class,
            $this->factory->build()
        );
    }

    public function testFactoryBuildsConnectionFromGivenConnectionFactory()
    {
        $this->factory->build();
        $this->assertSame($this->connectionParameters, $this->connectionFactorySpy->getConnectionParameters());
    }
}
