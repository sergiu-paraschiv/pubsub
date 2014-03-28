<?php namespace SergiuParaschiv\RabbitMQ;

use PhpAmqpLib\Connection\AMQPConnection;

class Connection extends AMQPConnection {
    
    public function __construct($config)
    {
        extract($config);
        
        parent::__construct($hostname, $port, $username, $password, $vhost);
    }
    
    public function channel($channel_id = null)
    {
        return new Channel($this, $channel_id);
    }
}