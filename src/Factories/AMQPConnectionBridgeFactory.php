<?php

namespace Jackrabbit\Factories;

use Jackrabbit\Bridges\AMQPConnectionBridge;

class AMQPConnectionBridgeFactory
{
    /**
     * @var AMQPConnectionFactory
     */
    private $connectionFactory;

    /**
     * @param AMQPConnectionFactory $connectionFactory
     */
    public function __construct(AMQPConnectionFactory $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * @return AMQPConnectionBridge
     */
    public function build()
    {
        return new AMQPConnectionBridge($this->connectionFactory);
    }
}
