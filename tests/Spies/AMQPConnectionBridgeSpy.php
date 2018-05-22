<?php

namespace Jackrabbit\Tests\Spies;

use Jackrabbit\Bridges\AMQPConnectionBridge;
use PhpAmqpLib\Channel\AMQPChannel;

class AMQPConnectionBridgeSpy extends AMQPConnectionBridge
{
    /**
     * @var AMQPChannel
     */
    private $channel;

    public function __construct(AMQPChannel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * @var int
     */
    private $numberOfChannelCalls = 0;

    /**
     * @return null
     */
    public function channel()
    {
        $this->numberOfChannelCalls++;

        return $this->channel;
    }

    /**
     * @return int
     */
    public function getNumberOfChannelCalls()
    {
        return $this->numberOfChannelCalls;
    }
}
