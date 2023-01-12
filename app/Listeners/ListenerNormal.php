<?php

namespace App\Listeners;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ListenerNormal implements ShouldQueue
{
    use Queueable;
    
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