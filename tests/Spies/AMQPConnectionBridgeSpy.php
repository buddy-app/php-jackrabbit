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

    /**
     * @var int
     */
    private $numberOfChannelCalls = 0;

    /**
     * @var int
     */
    private $numberOfCloseCalls = 0;

    /**
     * @param AMQPChannel $channel
     */
    public function __construct(AMQPChannel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return null
     */
    public function channel()
    {
        $this->numberOfChannelCalls++;

        return $this->channel;
    }

    public function close()
    {
        $this->numberOfCloseCalls++;
    }

    /**
     * @return int
     */
    public function getNumberOfChannelCalls()
    {
        return $this->numberOfChannelCalls;
    }

    /**
     * @return int
     */
    public function getNumberOfCloseCalls()
    {
        return $this->numberOfCloseCalls;
    }
}
