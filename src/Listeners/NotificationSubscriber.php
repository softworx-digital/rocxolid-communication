<?php

namespace Softworx\RocXolid\Communication\Listeners;

use Illuminate\Support\Collection;
use Illuminate\Events\Dispatcher;
// rocXolid communication services
use Softworx\RocXolid\Communication\Services\EmailService;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\EmailNotification;
// rocXolid communication event contracts
use Softworx\RocXolid\Communication\Events\Contracts\Sendable;

/**
 * Communication events listener.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class NotificationSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $dispatcher
     */
    public function subscribe(Dispatcher $dispatcher): NotificationSubscriber
    {
        $configured = collect(config('rocXolid.communication.events'))->keys();

        $configured->each(function ($event_class) use ($dispatcher) {
            $dispatcher->listen($event_class, function ($event) {
                $this->notify($event);
            });
        });

        return $this;
    }

    /**
     * Send appropriate notification for given event.
     *
     * @param \Softworx\RocXolid\Communication\Events\Contracts\Sendable $event
     * @return \Illuminate\Support\Collection
     */
    public function notify(Sendable $event): Collection
    {
        $emails = collect();

        try {
            $this->getEmails($event)->each(function ($email) use ($event, $emails) {
                $email->setEvent($event);
                $emails->push((new EmailService($email))->send());
            });
        } catch (\Exception $e) {
            // @todo hotfixed
            if (config('app.debug')) {
                throw $e;
            } else {
                logger()->error($e);
            }
        }

        return $emails;
    }

    /**
     * Search for appropriate email notifications for given event.
     *
     * @param \Softworx\RocXolid\Communication\Events\Contracts\Sendable $event
     * @return \Illuminate\Support\Collection
     */
    protected function getEmails(Sendable $event): Collection
    {
        return EmailNotification::where('event_type', get_class($event))->where('is_enabled', 1)->get();
    }
}
