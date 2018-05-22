<?php

namespace Jackrabbit\Tests;

use Jackrabbit\Entities\ConnectionParameters;
use Jackrabbit\Factories\ConnectionParametersFactory;
use PHPUnit\Framework\TestCase;

/**
 * Tests of connection parameters factory
 */
class ConnectionParametersFactoryTest extends TestCase
{
    /**
     * @var ConnectionParametersFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ConnectionParametersFactory();
    }

    public function testFactoryReturnsEmptyInstanceByDefault(){
        $this->assertEquals(new ConnectionParameters(), $this->factory->build(''));
    }

    /**
     * @dataProvider getDataProviderForBuildTests
     * @param string $connectionString
     * @param string $expectedUser
     * @param string $expectedPassword
     * @param string $expectedHost
     * @param string $expectedPort
     */
    public function testFactoryBuildsConnectionParametersFromConnectionString(
        $connectionString,
        $expectedUser,
        $expectedPassword,
        $expectedHost,
        $expectedPort
    ){
        $connectionParameters = $this->factory->build($connectionString);

        $expectedConnectionParameters = new ConnectionParameters();
        $expectedConnectionParameters->host = $expectedHost;
        $expectedConnectionParameters->password = $expectedPassword;
        $expectedConnectionParameters->port = $expectedPort;
        $expectedConnectionParameters->user = $expectedUser;

        $this->assertEquals($expectedConnectionParameters, $connectionParameters);
    }

    /**
     * @return array
     */
    public function getDataProviderForBuildTests(){
        return [
            ['', '', '', '', ''],
            ['ampq://', '', '', '', ''],
            ['amqp://', '', '', '', ''],
            ['amqp://user@', 'user', '', '', ''],
            ['amqp://[::1]', '', '', '[::1]', ''],
            ['amqp://host', '', '', 'host', ''],
            ['amqp://:15000', '', '', '', '15000'],
            ['amqp://mr:x@', 'mr', 'x', '', ''],
            ['amqp://mrs:y@rabbitmqserver', 'mrs', 'y', 'rabbitmqserver', ''],
            ['amqp://mrss:yy@rabbitmrserver:', 'mrss', 'yy', 'rabbitmrserver', ''],
            ['amqp://mrss:yy@rabbitmrserver:54321', 'mrss', 'yy', 'rabbitmrserver', '54321']
        ];
    }
}
