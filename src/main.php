<?php
declare(strict_types=1);

require_once('vendor/autoload.php');
use Enkatsu\PhpOsc\Server;

SDL_Init(SDL_INIT_EVERYTHING);
$window = SDL_CreateWindow(
  'Fixed pipeline example',
  SDL_WINDOWPOS_CENTERED,
  SDL_WINDOWPOS_CENTERED,
  640, 480,
  SDL_WINDOW_OPENGL | SDL_WINDOW_SHOWN
);
SDL_GL_CreateContext($window);

$server = new Server('localhost', 8338);
function drawFace($raw)
{
  $points = $raw->values->chunk(2);
  // TODO: https://github.com/Ponup/phpopengl/blob/master/examples/rectangle.php
}

SDL_GL_SwapWindow($window);

$event = new SDL_Event;
while(true) {
  // *** draw ***
  glClearColor(0, 0, .2, 1);
  glClear(GL_COLOR_BUFFER_BIT);
  $bundle = $server->recieve();
  $raw = $bundle->getElement('/raw');
  if(!is_null($raw)) drawFace($raw);
  // *** event ***
	SDL_PollEvent($event);
	if($event->type == SDL_KEYDOWN) break;
	SDL_Delay(50);
}

SDL_DestroyWindow($window);
