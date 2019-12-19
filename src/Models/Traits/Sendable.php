<?php

namespace Softworx\RocXolid\Communication\Models\Traits;

use Softworx\RocXolid\Communication\Models\CommunicationLog;

trait Sendable
{
    protected $_rendered_content = null;

    public function getSender($flat = false): string
    {
        return $this->sender;
    }

    public function getContent(): string
    {
        if (is_null($this->_rendered_content))
        {
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

    public function logActivity($success, $error_description = null)
    {
        $log = new CommunicationLog([
            'event' => $this->getEvent(),
            'sender' => $this->getSender(true),
            'recipient' => $this->getRecipient(),
            'subject' => $this->getSubject(),
            'content' => $this->getContent(),
            'is_success' => $success,
            'error_description' => $error_description,
        ]);

        $this->communicationLogs()->save($log);

        try
        {
            if ($this->getSendingModel($this->getEvent()))
            {
                $this->getSendingModel($this->getEvent())->communicationLogs()->save($log);
            }
        }
        catch (\Exception $e) // hotfix, kvoli affiliate (App\AjaxController)
        {

        }

        return $log;
    }
}