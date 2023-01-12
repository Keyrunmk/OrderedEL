<?php

namespace App\Facades;

use App\Services\QueueEventListeners;

class EventListener
{
    protected static function resolveFacade(string $class): QueueEventListeners
    {
        return resolve($class);
    }

    public static function __callStatic($name, $arguments)
    {
        (self::resolveFacade(QueueEventListeners::class))->$name(...$arguments);
    }
}