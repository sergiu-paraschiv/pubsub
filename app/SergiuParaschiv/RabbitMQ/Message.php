<?php namespace SergiuParaschiv\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

class Message extends AMQPMessage {

    public static function cast(AMQPMessage $message)
    {
        return new Message($message->body, $message->get_properties());
    }
}
