<?php

namespace Jackrabbit\Bridges;

use Jackrabbit\Factories\AMQPConnectionFactory;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AbstractConnection;

class AMQPConnectionBridge
{
    /**
     * @var AbstractConnection
     */
    private $connection;

    /**
     * @param AMQPConnectionFactory $connectionFactory
     */
    public function __construct(AMQPConnectionFactory $connectionFactory)
    {
        $this->connection = $connectionFactory->build();
    }

    /**
     * @return AMQPChannel
     */
    public function channel()
    {
        return $this->connection->channel();
    }
}
