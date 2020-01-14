<?php

namespace Softworx\RocXolid\Communication\Services;

use Softworx\RocXolid\Communication\Contracts\Sendable;

class SmsService
{
    const SERVICE_URL = 'http://as.eurosms.com/sms/Sender?action=send1SMSHTTP&i=1-4C71V3&c=A^c7L1v3&sender=%s&number=%s&msg=%s';

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

            return $success;
        } else {
            throw new \RuntimeException('Message is empty, cannot send!');
        }
    }

    public static function sendRaw($sender, $recipient, $content)
    {
        $url = sprintf(self::SERVICE_URL, urlencode($sender), $recipient, urlencode($content));

        dump($url);

        $response = @file_get_contents($url);

        dd($response);
    }

    private function sendToProvider()
    {
        // @todo - nejako inak renderovat content - asi cez fetchovanie componentu
        $response = @file_get_contents(sprintf(self::SERVICE_URL, $this->sendable->getSender(), $this->sendable->getRecipient(), urlencode($this->sendable->getContent())));

        if ($response) {
            list($status, $id) = explode('|', $response);

            return ($status == 'ok');
        } else {
            return false;
        }
    }
}
