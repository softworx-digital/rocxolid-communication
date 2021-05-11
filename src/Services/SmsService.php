<?php

namespace Softworx\RocXolid\Communication\Services;

// rocXolid communication services
use Softworx\RocXolid\Communication\Services\Contracts\NotificationService;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;

class SmsService implements Contracts\NotificationService
{
    const SERVICE_URL = 'http://as.eurosms.com/sms/Sender?action=send1SMSHTTP&i=1-4C71V3&c=A^c7L1v3&sender=%s&number=%s&msg=%s';

    public function send(Sendable $sendable)
    {
        if (!empty($sendable->getContent())) {
            $success = $this->sendToProvider();

            $sendable->logActivity($success);

            return $success;
        } else {
            throw new \RuntimeException('Message is empty, cannot send!');
        }
    }

    public static function sendRaw($sender, $recipient, $content)
    {
        $url = sprintf(self::SERVICE_URL, urlencode($sender), $recipient, urlencode($content));

        dump(__METHOD__, $url);

        $response = @file_get_contents($url);

        dd(__METHOD__, $response);
    }

    private function sendToProvider(): bool
    {
        // @todo nejako inak renderovat content - asi cez fetchovanie componentu
        $response = @file_get_contents(sprintf(self::SERVICE_URL, $sendable->getSender(), $sendable->getRecipient(), urlencode($sendable->getContent())));

        if ($response) {
            list($status, $id) = explode('|', $response);

            return ($status == 'ok');
        } else {
            return false;
        }
    }
}
