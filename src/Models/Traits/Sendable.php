<?php

namespace Softworx\RocXolid\Communication\Models\Traits;

use Illuminate\Support\Collection;
use Softworx\RocXolid\Communication\Contracts\CommunicationLoggable;
use Softworx\RocXolid\Communication\Models\CommunicationLog;

trait Sendable
{
    protected $_rendered_content = null;

    protected $status = null;

    protected $event = null;

    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getSender($flat = false): string
    {
        return $this->sender;
    }

    public function getContent(): string
    {
        if (is_null($this->_rendered_content)) {
            $this->_rendered_content = $this->renderContent();
        }

        return $this->_rendered_content;
    }

    public function communicationLogs()
    {
        return $this->morphMany(CommunicationLog::class, 'sendable');
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getSendingModel($event)
    {
        return null;
    }

    public function logActivity($success, $error_description = null)
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
}