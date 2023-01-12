<?php

namespace App\Services;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Bus;
use Throwable;

class QueueEventListeners
{
    public function queueSortListeners($event, array $listeners)
    {
        // foreach ($listeners as $listener) {
        //     if ($this->canQueueListeners($listener)) {
        //         dispatch(function() use($event, $listener){
        //             (app()->make($listener))->handle($event);
        //         })->onQueue("lol");
        //     }
        // }
        Bus::chain($listeners)
            ->catch(function(Throwable $exception){
                dd($exception);
            })
            ->onQueue("lol")->dispatch($event);
    }

    public function canQueueListeners(string $listener): bool
    {
        if (isset(class_implements($listener)[ShouldQueue::class])) {
            return true;
        }
        return false;
    }
}
