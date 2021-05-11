<?php

namespace Softworx\RocXolid\Communication\Services\Contracts;

// rocXolid communication models
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;

/**
 * Inteface for notification service.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
interface NotificationService
{
    /**
     * Send notification to recipient.
     *
     * @param \Softworx\RocXolid\Communication\Models\Contracts\Sendable $sendable
     */
    public function send(Sendable $sendable);
}
