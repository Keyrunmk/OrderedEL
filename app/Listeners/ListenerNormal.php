<?php

namespace App\Listeners;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Event;

class ListenerNormal implements ShouldQueue
{
    use Queueable;

    // public $queue = "normal";

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
}
