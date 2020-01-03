<?php

namespace Softworx\RocXolid\Communication\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Softworx\RocXolid\Services\ViewService;
use Softworx\RocXolid\Models\AbstractCrudModel;
use Softworx\RocXolid\Communication\Contracts\Sendable;
use Softworx\RocXolid\Communication\Models\Traits\Sendable as SendableTrait;
// common traits
use Softworx\RocXolid\Common\Models\Traits\UserGroupAssociatedWeb;
use Softworx\RocXolid\Common\Models\Traits\HasWeb;

/**
 *
 */
class EmailNotification extends AbstractCrudModel implements Sendable
{
    use SoftDeletes;
    use HasWeb;
    use UserGroupAssociatedWeb;
    use SendableTrait;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'event_type',
        'is_enabled',
        'sender_email',
        'sender_name',
        'recipient_email',
        'cc_recipient_email',
        'bcc_recipient_email',
        'subject',
        'content',
        'description'
    ];

    protected $relationships = [
        // 'web',
    ];

    public function getTitle()
    {
        return sprintf('<i class="fa fa-envelope-o mr-10"></i>%s', '');//$this->event);
    }

    public function getSender($flat = false)
    {
        if ($flat)
        {
            return sprintf('%s <%s>', $this->sender_name, $this->sender_email);
        }

        return [
            'email' => $this->sender_email,
            'name' => $this->sender_name,
        ];
    }

    public function getSubject(): string
    {
        return ViewService::render($this->subject, $this->event->getSendableVariables());
    }

    public function getRecipients(): Collection
    {
        $recipients = $this->event->getRecipients();

        if ($this->recipient_email) {
            $recipients->push($this->recipient_email);
        }

        return $recipients;
    }

    protected function renderContent(): string
    {
        $content = str_replace('-&gt;', '->', $this->content);
        $content = nl2br($content);

        return ViewService::render($content, $this->event->getSendableVariables());
    }

    public function getAttachments()
    {
        return [];
    }
}