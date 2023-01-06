<?php

namespace App\Listeners;

use App\Jobs\BatchJob;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Bus;

class ListenerBatch
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
            new BatchJob("List"),
            new BatchJob("ener"),
        ])->name("listener")->onQueue("")->dispatch();
    }
}
