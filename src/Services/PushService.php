<?php

namespace Softworx\RocXolid\Communication\Services;

use OneSignal;
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

            // @todo log failed recipients with Mail::failures()
            $sendable->logActivity($success);
            $sendable->setStatus($success);

            return $sendable;
        } else {
            throw new \RuntimeException('Message is empty, cannot send!');
        }
    }

    private function sendToProvider(Sendable $sendable): bool
    {
        $message = "Cau Samo, toto je testovacia pushka cez OneSignal do browsera :)";

        $sendable->getRecipients()->each(function ($user_id) use ($message) {
            OneSignal::sendNotificationToUser(
                $message,
                $user_id,
                // $url = null,
                // $data = null,
                // $buttons = null,
                // $schedule = null
            );
        });

        return false;
    }
}
