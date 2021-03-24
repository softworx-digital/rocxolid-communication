<?php

namespace Softworx\RocXolid\Communication\Models\Traits;

use Illuminate\Database\Eloquent\Relations;
// rocXolid communication contracts
use Softworx\RocXolid\Communication\Contracts\CommunicationLoggable;
// rocXolid communication event contracts
use Softworx\RocXolid\Communication\Events\Contracts\Sendable as SendableEvent;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Models\Contracts\Sendable as SendableContract;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\CommunicationLog;

/**
 * Trait to enable model to be sent.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
trait Sendable
{
    /**
     * @var string|null
     */
    protected $rendered_content = null;

    /**
     * @var string|null
     */
    protected $status = null;

    /**
     * @var \Softworx\RocXolid\Communication\Events\Contracts\Sendable|null
     */
    protected $event = null;

    /**
     * {@inheritDoc}
     */
    public function setEvent(SendableEvent $event): SendableContract
    {
        $this->event = $event;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus(bool $status): SendableContract
    {
        $this->status = $status;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSender($flat = false): string
    {
        return $this->sender;
    }

    /**
     * {@inheritDoc}
     */
    public function getPriority(): int
    {
        return $this->priority ?? 0;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent(): string
    {
        if (is_null($this->rendered_content)) {
            $this->rendered_content = $this->renderContent();
        }

        return $this->rendered_content;
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableTemplateVariables(): array
    {
        return app($this->event_type)->getSendableVariables();
    }

    /**
     * {@inheritDoc}
     */
    public function getEvent(): SendableEvent
    {
        return $this->event;
    }

    /**
     * {@inheritDoc}
     */
    public function logActivity(bool $success, ?string $error_description = null): CommunicationLog
    {
        $log = new CommunicationLog([
            'event' => get_class($this->getEvent()),
            'sender' => $this->getSender(true),
            'recipient' => $this->getRecipients()->join(';'),
            'subject' => $this->getSubject(),
            'content' => $this->getContent(),
            'is_success' => $success,
            'error_description' => $error_description,
        ]);

        $this->communicationLogs()->save($log);

        if ($this->getEvent()->getSendingModel() instanceof CommunicationLoggable) {
            $this->getEvent()->getSendingModel()->communicationLogs()->save($log);
        }

        return $log;
    }

    /**
     * Relation to log the communication.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function communicationLogs(): Relations\MorphMany
    {
        return $this->morphMany(CommunicationLog::class, 'sendable');
    }
}
