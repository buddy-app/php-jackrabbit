<?php

namespace Jackrabbit\Tests\Spies;

use Jackrabbit\Bridges\AMQPConnectionBridge;
use Jackrabbit\Factories\AMQPConnectionBridgeFactory;

class AMQPConnectionBridgeFactorySpy extends AMQPConnectionBridgeFactory
{
    /**
     * @var AMQPConnectionBridge
     */
    public $connectionBridge;

    public function __construct(AMQPConnectionBridge $connectionBridge)
    {
        $this->connectionBridge = $connectionBridge;
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

        return $this->connectionBridge;
    }

    /**
     * @return int
     */
    public function getNumberOfBuildCalls()
    {
        return $this->numberOfBuildCalls;
    }
}
