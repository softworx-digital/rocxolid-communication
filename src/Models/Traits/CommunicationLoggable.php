<?php

namespace Softworx\RocXolid\Communication\Models\Traits;

use Softworx\RocXolid\Communication\Models\CommunicationLog;

trait CommunicationLoggable
{
    public function communicationLogs()
    {
        return $this->morphMany(CommunicationLog::class, 'model');
    }
}