<?php

require __DIR__.'/../../bootstrap/autoload.php';

use SergiuParaschiv\RabbitMQ\Connection;
use SergiuParaschiv\RabbitMQ\Message;

$config = include('config.php');

$connection = new Connection($config);
$channel = $connection->channel();
$exchange = $channel->exchange('hello-exchange');

$exchange->publish(new Message('Hello World!'));
