<?php

namespace Softworx\RocXolid\Communication\Listeners;

use Illuminate\Support\Collection;
use Illuminate\Events\Dispatcher;
// rocXolid communication services
use Softworx\RocXolid\Communication\Services\EmailService;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\EmailNotification;
use Softworx\RocXolid\Communication\Models\PushNotification;
// rocXolid communication event contracts
use Softworx\RocXolid\Communication\Events\Contracts\Sendable;

/**
 * Communication events listener.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 * @todo [RX-122]
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
        $sendables = collect();

        try {
            $event->getNotificationTypes()->each(function (string $type) use ($event, $sendables) {
                $this->getSendables($event, $type)->each(function ($sendable) use ($event, $sendables) {
                    $sendable->setEvent($event);
                    $sendable = $sendable->getCrudController()->notificationService()->send($sendable);
                    $sendables->push($sendable);
                });
            });
        } catch (\Exception $e) {
            // @todo hotfixed
            if (config('app.debug')) {
                throw $e;
            } else {
                logger()->error($e);
            }
        }

        return $sendables;
    }

    /**
     * Search for appropriate sendable notifications for given event.
     *
     * @param \Softworx\RocXolid\Communication\Events\Contracts\Sendable $event
     * @param string $type
     * @return \Illuminate\Support\Collection
     */
    protected function getSendables(Sendable $event, string $type): Collection
    {
        if ($language = $event->getLanguage()) {
            return $type::where('event_type', get_class($event))
                ->where('language_id', $language->getKey())
                ->where('is_enabled', 1)
                ->get();
        }

        return $type::where('event_type', get_class($event))->where('is_enabled', 1)->get();
    }
}
