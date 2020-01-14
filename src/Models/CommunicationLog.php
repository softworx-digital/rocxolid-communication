<?php

namespace Softworx\RocXolid\Communication\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Softworx\RocXolid\Models\AbstractCrudModel;
use Softworx\RocXolid\Commerce\Models\Order;

class CommunicationLog extends AbstractCrudModel
{
    use SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'event',
        'sender',
        'recipient',
        'subject',
        'content',
        'is_success',
        'error_description',
    ];

    protected $relationships = [
    ];

    public function orders()
    {
        return $this->morphTo(Order::class);
    }

    public function sendable()
    {
        return $this->morphTo();
    }
}
