<?php

namespace App\Listeners;

use App\Traits\ShouldOrderQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class ListenerHigh implements ShouldQueue
{
    use Queueable;

    // public $queue = "high";

    public bool $shouldQueue = true;

    // public $afterCommit = true;

    public $event;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event=null)
    {
        $event = $event ?? $this->event;
        dd($event->message);
    }

    public function shouldQueue()
    {
        return $this->shouldQueue;
    }
}
