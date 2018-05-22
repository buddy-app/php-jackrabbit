<?php

namespace Jackrabbit\Tests\Spies;

use Exception;
use Jackrabbit\Entities\ConnectionParameters;
use Jackrabbit\Factories\AMQPConnectionFactory;
use Jackrabbit\Tests\Stubs\AbstractConnectionStub;
use PhpAmqpLib\Connection\AbstractConnection;

class AMQPConnectionFactorySpy extends AMQPConnectionFactory
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
     * @return AbstractConnection
     * @throws Exception
     */
    public function build()
    {
        return new AbstractConnectionStub();
    }

    /**
     * @return ConnectionParameters
     */
    public function getConnectionParameters()
    {
        return $this->connectionParameters;
    }
}
