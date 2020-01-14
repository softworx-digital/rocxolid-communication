<?php

namespace Softworx\RocXolid\Communication\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Softworx\RocXolid\Models\AbstractCrudModel;
use Softworx\RocXolid\Communication\Models\Traits\Sendable as SendableTrait;

class SmsNotification extends AbstractCrudModel
{
    use SoftDeletes;
    use SendableTrait;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'event_type',
        'sender',
        'recipient_phone_number',
        'content',
        'description'
    ];

    protected $relationships = [
    ];

    public function getTitle()
    {
        return '<i class="fa fa-mobile fa-2x fa-fw"></i>';
    }

    public function getSendingModel($action)
    {
        //...?
    }

    public function getSubject()
    {
        return null;
    }
}
