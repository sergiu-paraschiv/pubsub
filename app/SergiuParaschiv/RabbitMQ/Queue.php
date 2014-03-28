<?php namespace SergiuParaschiv\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

class Queue {
    
    public $exchange;
    private $name;
    private $routingKey;
    
    public function __construct(Exchange $exchange, $name, $routingKey)
    {
        $this->exchange = $exchange;
        $this->name = $name;
        $this->routingKey = $routingKey;

        $this->exchange->channel->queue_declare($this->name, false, false, false, false);
        $this->exchange->channel->queue_bind($this->name, $this->exchange->getName(), $this->routingKey);
    }
    
    public function consume($callback, $tag = '')
    {
        $internalCallback = function(AMQPMessage $message) use ($callback) {
            return $callback(Message::cast($message));
        };

        $this->exchange->channel->basic_consume($this->name, $tag, false, true, false, false, $internalCallback);

        while(count($this->exchange->channel->callbacks))
        {
            $this->exchange->channel->wait();
        }
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getRoutingKey()
    {
        return $this->routingKey;
    }
}
