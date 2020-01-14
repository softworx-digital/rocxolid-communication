<?php

namespace Softworx\RocXolid\Communication\Services;

use Mail;
use Softworx\RocXolid\Communication\Contracts\Sendable;

class EmailService
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

            $this->sendable->logActivity($success);
            $this->sendable->setStatus($success);

            return $this->sendable;
        } else {
            throw new \RuntimeException('Message is empty, cannot send!');
        }
    }

    private function sendToProvider()
    {
        // @todo - nejako inak renderovat content - asi cez fetchovanie componentu
        Mail::send('emails.default', [ 'content' => $this->sendable->getContent() ], function ($message) {
            $sender = $this->sendable->getSender();

            $message->subject($this->sendable->getSubject());
            $message->from($sender['email'], $sender['name']);

            $this->sendable->getRecipients()->each(function ($address) use ($message) {
                $message->to($address);
            });

            if (isset($this->sendable->cc_recipient_email)) {
                collect(explode(',', $this->sendable->cc_recipient_email))->each(function ($address) use ($message) {
                    $message->cc($address);
                });
            }

            if (isset($this->sendable->bcc_recipient_email)) {
                collect(explode(',', $this->sendable->bcc_recipient_email))->each(function ($address) use ($message) {
                    $message->bcc($address);
                });
            }

            foreach ($this->sendable->getAttachments() as $file) {
                $message->attach($file);
            }
        });

        return true;
    }
}
