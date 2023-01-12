<?php

namespace App\Listeners;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenerHigh implements ShouldQueue
{
    use Queueable;

    public bool $shouldQueue = true;

    public $event;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($event=null)
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
        echo($event->message);
    }
}
