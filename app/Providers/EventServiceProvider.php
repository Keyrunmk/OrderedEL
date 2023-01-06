<?php

namespace App\Providers;

use App\Events\TestEvent;
use App\Listeners\ListenerBa;
use App\Listeners\ListenerBatch;
use App\Listeners\ListenerHigh;
use App\Listeners\ListenerNormal;
use App\Listeners\ListenerOne;
use App\Listeners\ListenerThree;
use App\Listeners\ListenerTwo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $orderedListener = [
        TestEvent::class => [
            [ListenerOne::class, 30],
            [ListenerTwo::class, 1],
            [ListenerThree::class, 2],
            [ListenerHigh::class,5],
            // [ListenerBa::class, 6],
            // [ListenerBatch::class, 7],
            [ListenerNormal::class, 14],
        ],
    ];
    
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->orderedListener as $event => $listeners) {
            $listeners = collect($listeners)->sortByDesc(1)->map(fn ($listener) => $listener[0])->toArray();

            foreach ($listeners as $listener) {
                if (isset(class_implements($listener)[ShouldQueue::class])) {
                    if (method_exists($listener, "dispatch")) {
                        $listenerInstance = app()->make($listener);
                        Event::listen($event, [$listenerInstance, "dispatch"]);
                        continue;
                    }
                }
                Event::listen($event, $listener);
            }
        }   
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}