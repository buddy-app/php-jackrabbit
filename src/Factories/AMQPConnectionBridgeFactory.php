<?php

namespace Jackrabbit\Factories;

use Jackrabbit\Bridges\AMQPConnectionBridge;
use Jackrabbit\Entities\ConnectionParameters;

class AMQPConnectionBridgeFactory
{
    /**
     * @var ConnectionParameters
     */
    private $connectionParameters;

    /**
     * @param ConnectionParameters $connectionParameters
     */
    public function __construct(ConnectionParameters $connectionParameters)
    {
        $this->connectionParameters = $connectionParameters;
    }

    /**
     * @return AMQPConnectionBridge
     */
    public function build(){
        return new AMQPConnectionBridge(
            $this->connectionParameters->host,
            $this->connectionParameters->port,
            $this->connectionParameters->user,
            $this->connectionParameters->password
        );
    }
}
