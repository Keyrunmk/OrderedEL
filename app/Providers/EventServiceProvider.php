<?php

namespace App\Providers;

use App\Events\TestEvent;
use App\Facades\EventListener;
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
use Illuminate\Support\Arr;
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
            // [ListenerOne::class, 30],
            // [ListenerTwo::class, 1],
            // [ListenerThree::class, 2],
            [ListenerHigh::class, 5],
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
        Event::listen(function (TestEvent $event) {
            EventListener::queueSortListeners($event, Arr::sortListeners($this->orderedListener[get_class($event)]));
        });
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
