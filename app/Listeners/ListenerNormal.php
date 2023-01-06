<?php

namespace App\Listeners;

use App\Traits\ShouldOrderQueue;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerNormal implements ShouldQueue
{
    use ShouldOrderQueue;

    public $queue = "normal";

    public bool $shouldQueue = true;

    public $afterCommit = true;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // echo "$event->message";
        echo "Normal";
    }

    public function shouldQueue()
    {
        return $this->shouldQueue;
    }
}
