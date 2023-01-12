<?php

namespace App\Listeners;

use App\Jobs\BatchJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Bus;

class ListenerBa
{
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
        Bus::batch([
            new BatchJob("Bat"),
            new BatchJob("ched"),
        ])->name("Batch")->onQueue("batch")->dispatch();
    }
}
