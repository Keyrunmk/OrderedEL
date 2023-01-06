<?php

namespace App\Traits;

trait ShouldOrderQueue
{
    public $orderedQueue = "";

    public $orderedConnection = "";

    public function dispatch($event)
    {
        dispatch(function() use ($event) {
            $this->handle($event);
        })->onConnection($this->orderedConnection)->onQueue($this->orderedQueue);
    }
}