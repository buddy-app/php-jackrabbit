<?php

namespace Jackrabbit\Factories;

use Jackrabbit\Entities\ConnectionParameters;
use PhpAmqpLib\Connection\AbstractConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AMQPConnectionFactory
{
    /**
     * @var AbstractConnection
     */
    private $connection;

    /**
     * @param ConnectionParameters $connectionParameters
     */
    public function __construct(ConnectionParameters $connectionParameters)
    {
        $this->connection = new AMQPStreamConnection(
            $connectionParameters->host,
            $connectionParameters->port,
            $connectionParameters->user,
            $connectionParameters->password
        );
    }

    /**
     * @return AbstractConnection
     */
    public function build()
    {
        return $this->connection;
    }
}
