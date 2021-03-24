<?php

namespace Softworx\RocXolid\Communication\Services;

use OneSignal;
//
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
//
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;

class PushService
{
    private $sendable;

    public function __construct(Sendable $sendable)
    {
        $this->sendable = $sendable;
    }

    public function send()
    {
        if (!empty($this->sendable->getContent())) {
            $success = $this->sendToProvider();

            // @todo log failed recipients with Mail::failures()
            $this->sendable->logActivity($success);
            $this->sendable->setStatus($success);

            return $this->sendable;
        } else {
            throw new \RuntimeException('Message is empty, cannot send!');
        }
    }

    private function sendToProvider(): bool
    {
        $message = "Cau Samo, toto je testovacia pushka cez OneSignal do browsera :)";

        $this->sendable->getRecipients()->each(function ($user_id) use ($message) {
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
