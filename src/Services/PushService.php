<?php

namespace Softworx\RocXolid\Communication\Services;

use Berkayk\OneSignal\OneSignalClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
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
        try {
            $sendable->getRecipients()->each(function ($recipient) use ($sendable) {
                $config = config(sprintf('onesignal.%s', $sendable->config ?: 'default'));

                $client = new OneSignalClient($config['app_id'], $config['rest_api_key'], $config['user_auth_key']);
                $client->sendNotificationToUser(
                    $sendable->getContent(),
                    $recipient,
                    $sendable->getUrl(),
                    $sendable->getData(),
                    null,
                    null,
                    $sendable->getSubject(),
                    $sendable->getSubtitle(),
                );
            });
        } catch (ClientException $e) {
            logger()->error($e);
            return false;
        } catch (RequestException $e) {
            logger()->error($e);
            return false;
        }

        return true;
    }
}
