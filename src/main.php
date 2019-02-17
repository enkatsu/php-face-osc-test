<?php
require_once('vendor/autoload.php');

use Enkatsu\PhpOscServer\Server;

$server = new Server('localhost', 8338);

while(true) {
  $messages = $server->recieve();
  var_dump($messages);
  sleep(1);
}
