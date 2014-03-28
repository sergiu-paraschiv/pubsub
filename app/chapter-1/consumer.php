<?php

require __DIR__.'/../../bootstrap/autoload.php';

use SergiuParaschiv\RabbitMQ\Connection;
use SergiuParaschiv\RabbitMQ\Message;

$config = include('config.php');

$connection = new Connection($config);
$channel = $connection->channel();
$exchange = $channel->exchange('hello-exchange');
$queue = $exchange->queue('hello-queue');

$callback = function(Message $message) {
    echo $message->body . PHP_EOL;
};

$queue->consume($callback);