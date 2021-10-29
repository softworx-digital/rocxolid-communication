<?php

namespace Softworx\RocXolid\Communication\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Softworx\RocXolid\Models\AbstractCrudModel;

class CommunicationLog extends AbstractCrudModel
{
    use SoftDeletes;

    protected $fillable = [
        'event',
        'sender',
        'recipient',
        'subject',
        'content',
        'data',
        'is_success',
        'error_description',
    ];

    protected $relationships = [
    ];

    public function sendable()
    {
        return $this->morphTo();
    }

    public function model()
    {
        return $this->morphTo();
    }
}
