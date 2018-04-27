<?php

namespace Jackrabbit\Tests\Spies;

use Jackrabbit\Bridges\AMQPConnectionBridge;
use Jackrabbit\Entities\ConnectionParameters;
use Jackrabbit\Factories\AMQPConnectionBridgeFactory;
use Jackrabbit\Tests\Stubs\AMQPConnectionBridgeStub;

class AMQPConnectionBridgeFactorySpy extends AMQPConnectionBridgeFactory
{
    public function __construct()
    {
    }

    /**
     * @var int
     */
    private $numberOfBuildCalls = 0;

    /**
     * @return AMQPConnectionBridge
     */
    public function build()
    {
        $this->numberOfBuildCalls++;

        return new AMQPConnectionBridgeStub();
    }

    /**
     * @return int
     */
    public function getNumberOfBuildCalls()
    {
        return $this->numberOfBuildCalls;
    }
}
