<?php
require_once('vendor/autoload.php');

use Enkatsu\PhpOscServer\Server;

$server = new Server('localhost', 8338);

while(true) {
  $messages = $server->recieve();
  $messages->each(function($message) {
    $address = $message->address;
    $values = $message->values->implode(',');
    echo("$address: $values".PHP_EOL);
  });
}
