<?php

namespace Jackrabbit;

use Jackrabbit\Bridges\AMQPConnectionBridge;
use Jackrabbit\Factories\AMQPConnectionBridgeFactory;
use PhpAmqpLib\Message\AMQPMessage;

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
     * @var string
     */
    private $lastMethod;

    /**
     * @param AMQPConnectionBridgeFactory $connectionBridgeFactory
     */
    public function __construct(AMQPConnectionBridgeFactory $connectionBridgeFactory)
    {
        $this->connectionBridgeFactory = $connectionBridgeFactory;

        $this->connectionBridge = $connectionBridgeFactory->build();
    }

    /**
     * @param string $name
     * @param mixed $arguments
     */
    public function __call($name, $arguments)
    {
        $this->lastMethod = $name;
        $channel = $this->connectionBridge->channel();

        $jsonRequest =
            0 === count($arguments)
                ? null
                : json_encode($arguments[0]);

        $channel->basic_publish(
            new AMQPMessage($jsonRequest),
            $name
        );
    }

    /**
     * @return string
     */
    public function getLastMethod()
    {
        return $this->lastMethod;
    }
}
