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
        if (!empty($this->sendable->getContent()))
        {
            $success = $this->sendToProvider();

            $this->sendable->logActivity($success);

            return $success;
        }
        else
        {
            throw new \RuntimeException('Message is empty, cannot send!');
        }
    }

    private function sendToProvider()
    {
        // @todo - nejako inak renderovat content - asi cez fetchovanie componentu
        Mail::send('emails.plain', [ 'content' => $this->sendable->getContent() ], function ($message)
        {
            $sender = $this->sendable->getSender();

            $message->subject($this->sendable->getSubject());
            $message->from($sender['email'], $sender['name']);
            $message->to($this->sendable->getRecipient());

            foreach ($this->sendable->getAttachments() as $file)
            {
                $message->attach($file);
            }
        });

        return true;
    }
}