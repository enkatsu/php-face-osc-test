<?php
require_once('vendor/autoload.php');

use Enkatsu\PhpOsc\Server;

$server = new Server('localhost', 8338);
while(true)
{
  $bundle = $server->recieve();
  if(is_null($bundle)) continue;
  echo("***\n");
  $bundle->getElements()->each(function($message) use (&$str)
  {
    $address = $message->address;
    $values = $message->values->implode(', ');
    echo("$address: $values\n");
  });
}
