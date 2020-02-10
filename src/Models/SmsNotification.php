<?php

namespace Softworx\RocXolid\Communication\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
// rocXolid models
use Softworx\RocXolid\Models\AbstractCrudModel;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;
// rocXolid communication model traits
use Softworx\RocXolid\Communication\Models\Traits\Sendable as SendableTrait;

/**
 * Sendable SMS notification.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Admin
 * @version 1.0.0
 */
class SmsNotification extends AbstractCrudModel implements Sendable
{
    use SoftDeletes;
    use SendableTrait;

    protected $fillable = [
        'event_type',
        'sender',
        'recipient_phone_number',
        'content',
        'description'
    ];

    protected $relationships = [
    ];

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return '<i class="fa fa-mobile fa-2x fa-fw"></i>';
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipient(string $recipient): Sendable
    {
        $this->recipient_phone_number = $recipient;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipients(): Collection
    {
        if ($this->recipient_phone_number) {
            return collect($this->recipient_phone_number);
        } else {
            return $this->event->getRecipients();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getSubject()
    {
        return null;
    }
}
