<?php

namespace Softworx\RocXolid\Communication\Listeners;

use Softworx\RocXolid\Communication\Services\EmailService;
use Softworx\RocXolid\Communication\Models\EmailNotification;

class NotificationSubscriber
{
    public function notify($event)
    {
dump(__METHOD__);

        if ($email = EmailNotification::where('event', get_class($event))->first()) {
            $success = (new EmailService($email))->send();
dump($success);
        }


dd($event);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $configured = collect(config('rocXolid.communication.general.events'))->keys();

        $configured->each(function($event_class) use ($events) {
            $events->listen($event_class, function($event) {
                $this->notify($event);
            });
        });
    }
}