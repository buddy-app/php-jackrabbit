<?php

namespace Jackrabbit\Tests\Spies;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class AMQPChannelSpy extends AMQPChannel
{
    /**
     * @var array
     */
    private $calls;

    public function __construct()
    {
    }

    /**
     * @param AMQPMessage $msg
     * @param string $exchange
     * @param string $routing_key
     * @param bool $mandatory
     * @param bool $immediate
     * @param null $ticket
     */
    public function basic_publish(
        $msg,
        $exchange = '',
        $routing_key = '',
        $mandatory = false,
        $immediate = false,
        $ticket = null
    )
    {
        $this->calls[__FUNCTION__] = [
            $msg,
            $exchange,
            $routing_key,
            $mandatory,
            $immediate,
            $ticket,
        ];
    }

    /**
     * @return array
     */
    public function getCalls()
    {
        return $this->calls;
    }
}
