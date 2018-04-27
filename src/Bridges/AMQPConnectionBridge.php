<?php

namespace Jackrabbit\Bridges;

class AMQPConnectionBridge
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $user;

    /**
     * @param string $host
     * @param string $port
     * @param string $user
     * @param string $password
     */
    public function __construct($host, $port, $user, $password)
    {
        $this->host = $host;
        $this->password = $password;
        $this->port = $port;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
}
