<?php

namespace App\Listeners;

use App\Traits\ShouldOrderQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerHigh implements ShouldQueue
{
    use ShouldOrderQueue;

    public $queue = "high";

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
        // echo"$event->message";
        echo "High";
    }

    public function shouldQueue()
    {
        return $this->shouldQueue;
    }
}
