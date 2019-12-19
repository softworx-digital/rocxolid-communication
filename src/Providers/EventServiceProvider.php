<?php

namespace Softworx\RocXolid\Communication\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as IlluminateServiceProvider;

/**
 * rocXolid events service provider.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class EventServiceProvider extends IlluminateServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        \Softworx\RocXolid\Communication\Listeners\NotificationSubscriber::class,
    ];
}
