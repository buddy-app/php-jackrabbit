<?php

namespace Jackrabbit\Factories;

use Jackrabbit\Entities\ConnectionParameters;

class ConnectionParametersFactory
{
    /**
     * @param string $connectionString
     * @return ConnectionParameters
     */
    public function build($connectionString){
        $tokens = [];
        preg_match('/amqp:\/\/(.*)/', $connectionString, $tokens);

        $host = '';
        if(count($tokens) > 1){
            $host = $tokens[1];
        }

        $connectionParameters = new ConnectionParameters();
        $connectionParameters->host = $host;
        return $connectionParameters;
    }
}
