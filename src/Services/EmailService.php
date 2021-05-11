<?php

namespace Softworx\RocXolid\Communication\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;

class EmailService implements Contracts\NotificationService
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
        Mail::send('emails.default', [
            'content' => $sendable->getContent(),
        ], function (Message $message) use ($sendable) {
            $sender = $sendable->getSender();

            $message->priority($sendable->getPriority());
            $message->subject($sendable->getSubject());
            $message->from($sender['email'], $sender['name']);

            $sendable->getRecipients()->each(function ($address) use ($message) {
                $message->to($address);
            });

            if (isset($sendable->cc_recipient_email)) {
                collect(explode(',', $sendable->cc_recipient_email))->each(function ($address) use ($message) {
                    $message->cc($address);
                });
            }

            if (isset($sendable->bcc_recipient_email)) {
                collect(explode(',', $sendable->bcc_recipient_email))->each(function ($address) use ($message) {
                    $message->bcc($address);
                });
            }

            foreach ($sendable->getAttachments() as $file) {
                $message->attach($file);
            }
        });

        return collect(Mail::failures())->isEmpty();
    }
}
