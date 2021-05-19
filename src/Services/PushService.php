<?php

namespace Softworx\RocXolid\Communication\Services;

use OneSignal;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
// rocXolid communication services
use Softworx\RocXolid\Communication\Services\Contracts\NotificationService;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;

class PushService implements Contracts\NotificationService
{
    public function send(Sendable $sendable)
    {
        if (!empty($sendable->getContent())) {
            $success = $this->sendToProvider($sendable);

            $sendable->logActivity($success);
            $sendable->setStatus($success);

            return $sendable;
        } else {
            throw new \RuntimeException('Message is empty, cannot send!');
        }
    }

    private function sendToProvider(Sendable $sendable): bool
    {
        $sendable->getRecipients()->each(function ($recipient) use ($sendable) {
            try {
                OneSignal::sendNotificationToUser(
                    $sendable->getContent(),
                    $recipient,
                    $sendable->getUrl(),
                    $sendable->getData(),
                    null,
                    null,
                    $sendable->getSubject(),
                    $sendable->getSubtitle(),
                );
            } catch (ClientException $e) { // @todo hotfixed
                // ignore
            }
        });

        return true;
    }
}
