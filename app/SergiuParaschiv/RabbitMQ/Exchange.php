<?php namespace SergiuParaschiv\RabbitMQ;

class Exchange {
    
    public $channel;
    private $name;
    
    public function __construct(Channel $channel, $name)
    {
        $this->channel = $channel;
        $this->name = $name;
        
        $this->channel->exchange_declare($this->name, 'direct', false, false, false);
    }
    
    public function publish(Message $message)
    {
        $this->channel->basic_publish($message, $this->name);
        
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function queue($name, $routingKey = '')
    {
        return new Queue($this, $name, $routingKey);
    }
}
