<?php

namespace Jackrabbit\Factories;

use Jackrabbit\Entities\ConnectionParameters;

class ConnectionParametersFactory
{
    const REGEX_HOST_AND_CREDENTIALS = '/(.*)@(.*)/';
    const REGEX_TUPLE = '/(.*):(.*)/';

    /**
     * @param string $connectionString
     * @return ConnectionParameters
     */
    public function build($connectionString){

        $connectionParameters = new ConnectionParameters();

        $connectionParameters->host = $this->getHostFromConnectionString($connectionString);
        $connectionParameters->user = $this->getUsernameFromConnectionString($connectionString);
        $connectionParameters->password = $this->getPasswordFromConnectionString($connectionString);
        $connectionParameters->port = $this->getPortFromConnectionString($connectionString);

        return $connectionParameters;
    }

    /**
     * @param string $connectionString
     * @return string
     */
    private function getUsernameFromConnectionString($connectionString)
    {
        $credentials = $this->getCredentialsFromConnectionString($connectionString);

        return $this->getRegexGroupValue(
            static::REGEX_TUPLE,
            $credentials,
            [1],
            $credentials
        );
    }

    /**
     * @param string $connectionString
     * @return string
     */
    private function getPasswordFromConnectionString($connectionString)
    {
        return $this->getRegexGroupValue(
            static::REGEX_TUPLE,
            $this->getCredentialsFromConnectionString($connectionString),
            [2]
        );
    }

    /**
     * @param string $connectionString
     * @return string
     */
    private function getCredentialsFromConnectionString($connectionString)
    {
        return $this->getRegexGroupValue(
            static::REGEX_HOST_AND_CREDENTIALS,
            $this->getHostAndCredentialsFromConnectionString($connectionString),
            [1]
        );
    }

    /**
     * @param string $connectionString
     * @return string
     */
    private function getHostFromConnectionString($connectionString)
    {
        $hostAndPort = $this->getHostAndPortFromConnectionString($connectionString);

        $host = $this->getRegexGroupValue(
            static::REGEX_TUPLE,
            $hostAndPort,
            [1],
            $hostAndPort
        );

        if (preg_match('/\[|\]/', $host)) {
            return $hostAndPort;
        }

        return $host;
    }

    /**
     * @param string $connectionString
     * @return string
     */
    private function getPortFromConnectionString($connectionString)
    {
        $port = $this->getRegexGroupValue(
            static::REGEX_TUPLE,
            $this->getHostAndPortFromConnectionString($connectionString),
            [2]
        );

        if (preg_match('/\[|\]/', $port)) {
            return '';
        }

        return $port;
    }

    /**
     * @param string $connectionString
     * @return string
     */
    private function getHostAndPortFromConnectionString($connectionString)
    {
        $hostAndCredentials = $this->getHostAndCredentialsFromConnectionString($connectionString);
        return $this->getRegexGroupValue(
            static::REGEX_HOST_AND_CREDENTIALS,
            $hostAndCredentials,
            [2],
            $hostAndCredentials
        );
    }

    /**
     * @param string $connectionString
     * @return string
     */
    private function getHostAndCredentialsFromConnectionString($connectionString)
    {
        return $this->getRegexGroupValue(
            '/amqp:\/\/(.*)/',
            $connectionString,
            [1]
        );
    }

    /**
     * @param string $regularExpression
     * @param string $subject
     * @param int[] $groupIndexes
     * @param string $defaultValue
     * @return string
     */
    private function getRegexGroupValue($regularExpression, $subject, array $groupIndexes, $defaultValue = ''){
        $tokens = [];
        preg_match($regularExpression, $subject, $tokens);

        foreach ($groupIndexes as $groupIndex){
            if(count($tokens) > $groupIndex){
                return $tokens[$groupIndex];
            }
        }

        return $defaultValue;
    }
}
