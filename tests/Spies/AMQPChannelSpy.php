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

    /**
     * @var int
     */
    private $numberOfCloseCalls = 0;

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

    public function close($reply_code = 0, $reply_text = '', $method_sig = array(0, 0))
    {
        $this->numberOfCloseCalls++;
    }

    /**
     * @return array
     */
    public function getCalls()
    {
        return $this->calls;
    }

    /**
     * @return int
     */
    public function getNumberOfCloseCalls()
    {
        return $this->numberOfCloseCalls;
    }
}
