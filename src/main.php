<?php
require_once('vendor/autoload.php');

use Enkatsu\PhpOscServer\Server;

$server = new Server('localhost', 8338);
// $stdout = fopen('php://stdout', 'w');
while(true) {
  $bundle = $server->recieve();
  echo("***\n");
  $bundle->getElements()->each(function($message) use (&$str)
  {
    $address = $message->address;
    $values = $message->values->implode(', ');
    echo("$address: $values\n");
  });
}
