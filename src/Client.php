<?php

namespace Jackrabbit;
use Jackrabbit\Bridges\AMQPConnectionBridge;
use Jackrabbit\Factories\AMQPConnectionBridgeFactory;

/**
 * Jackrabbit client
 */
class Client
{
    /**
     * @var AMQPConnectionBridge
     */
    private $connectionBridge;

    /**
     * @var AMQPConnectionBridgeFactory
     */
    private $connectionBridgeFactory;

    /**
     * @param AMQPConnectionBridgeFactory $connectionBridgeFactory
     */
    public function __construct(AMQPConnectionBridgeFactory $connectionBridgeFactory)
    {
        $this->connectionBridgeFactory = $connectionBridgeFactory;

        $this->connectionBridge = $connectionBridgeFactory->build();
    }
}
