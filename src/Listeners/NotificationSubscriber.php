<?php

namespace Softworx\RocXolid\Communication\Listeners;

use Illuminate\Support\Collection;
use Softworx\RocXolid\Communication\Services\EmailService;
use Softworx\RocXolid\Communication\Models\EmailNotification;

class NotificationSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $configured = collect(config('rocXolid.communication.events'))->keys();

        $configured->each(function($event_class) use ($events) {
            $events->listen($event_class, function($event) {
                $this->notify($event);
            });
        });
    }

    // @todo: type hint (& create interface before)
    /**
     * Send appropriate notification for given event.
     *
     * @param \Softworx\RocXolid\Communication\Events\Contracts\Sendable $event
     * @return \Illuminate\Support\Collection
     */
    public function notify($event): Collection
    {
        $emails = new Collection();

        $this->getEmails($event)->each(function($email) use ($event, $emails) {
            $email->setEvent($event);
            $emails->push((new EmailService($email))->send());
        });

        return $emails;
    }

    /**
     * Search for appropriate email notifications for given event.
     *
     * @param \Softworx\RocXolid\Communication\Events\Contracts\Sendable $event
     * @return \Illuminate\Support\Collection
     */
    protected function getEmails($event): Collection
    {
        return EmailNotification::where('event_type', get_class($event))->where('is_enabled', 1)->get();
    }
}