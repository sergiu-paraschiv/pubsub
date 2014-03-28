<?php namespace SergiuParaschiv\RabbitMQ;

use PhpAmqpLib\Channel\AMQPChannel;

class Channel extends AMQPChannel {
    
    public $connection;
    private $id;
    
    public function __construct(Connection $connection, $id = null)
    {
        $this->connection = $connection;
        $this->id = $id;
        
        parent::__construct($this->connection, $id);
    }
    
    public function getID()
    {
        return $this->id;
    }
    
    public function exchange($name, $deleteExisting = false)
    {
        if($deleteExisting)
        {
            $this->deleteExchange($name);
        }
        
        return new Exchange($this, $name);
    }
    
    public function deleteExchange($name)
    {
        $this->exchange_delete($name);
        
        return $this;
    }
}
