<?php
declare(strict_types=1);

require_once('vendor/autoload.php');
use Enkatsu\PhpOsc\Server;

function draw($renderer, $server)
{
  SDL_SetRenderDrawColor($renderer, 0, 0, 0, 255);
  SDL_RenderClear($renderer);
  $bundle = $server->recieve();
  $raw = $bundle->getElement('/raw');
  if(!is_null($raw)) drawFace($renderer, $raw);
  SDL_RenderPresent($renderer);
}

function drawFace($renderer, $raw)
{
  SDL_SetRenderDrawColor($renderer, 255, 255, 255, 255);
  $points = $raw->values->chunk(2)->values();
  $points->each(function($point, $i) use ($renderer)
  {
    SDL_RenderDrawPoint($renderer, (int)$point->shift(), (int)$point->shift());
  });
}

$server = new Server('localhost', 8338);
$window = SDL_CreateWindow('Primitive drawing example', SDL_WINDOWPOS_UNDEFINED, SDL_WINDOWPOS_UNDEFINED, 640, 480, SDL_WINDOW_SHOWN);
$renderer = SDL_CreateRenderer($window, 0, SDL_RENDERER_SOFTWARE);
$event = new SDL_Event;

while(true)
{
  draw($renderer, $server);
	SDL_PollEvent($event);
	if($event->type == SDL_KEYDOWN) break;
}

SDL_DestroyRenderer($renderer);
SDL_DestroyWindow($window);
SDL_Quit();
