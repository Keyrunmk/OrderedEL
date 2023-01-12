<?php

namespace App\Services;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Bus;
use Throwable;

class QueueEventListeners
{
    public function queueSortListeners($event, array $listeners)
    {
        Bus::chain(array_map(fn($listener) => new $listener($event),$listeners))
            ->catch(function(Throwable $exception){
                dd($exception);
            })
            ->onQueue("lol")->dispatch();
    }
}
