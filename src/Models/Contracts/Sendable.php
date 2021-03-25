<?php

namespace Softworx\RocXolid\Communication\Models\Contracts;

use Illuminate\Support\Collection;
// rocXolid communication events contracts
use Softworx\RocXolid\Communication\Events\Contracts\Sendable as SendableEvent;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\CommunicationLog;

/**
 * Interface to enable model to be sent.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
interface Sendable
{
    /**
     * Set the event that triggered notification.
     *
     * @param \Softworx\RocXolid\Communication\Events\Contracts\Sendable $event Event that triggered notification.
     * @return \Softworx\RocXolid\Communication\Models\Contracts\Sendable
     */
    public function setEvent(SendableEvent $event): Sendable;

    /**
     * Get the event that triggered notification.
     *
     * @return \Softworx\RocXolid\Communication\Events\Contracts\Sendable
     */
    public function getEvent();

    /**
     * Get the notification sender.
     *
     * @param bool $flat Flag to return flattened sender reference (in a string).
     * @return string|array
     */
    public function getSender(bool $flat = false);

    /**
     * Get message priority.
     *
     * @return integer
     */
    public function getPriority(): int;

    /**
     * Set notification recipient.
     *
     * @param string $recipient Notification recipient.
     * @return \Softworx\RocXolid\Communication\Models\Contracts\Sendable
     */
    public function setRecipient(string $recipient): Sendable;

    /**
     * Get notification recipients.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRecipients(): Collection;

    /**
     * Get notification content.
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Get notification attachments.
     *
     * @return array
     */
    public function getAvailableTemplateVariables(): array;

    /**
     * Log notification activity.
     *
     * @param bool $success Flag whether the sending was successful.
     * @param string|null $error_description Optional error description.
     * @return \Softworx\RocXolid\Communication\Models\CommunicationLog
     */
    public function logActivity(bool $success, ?string $error_description = null): CommunicationLog;
}
