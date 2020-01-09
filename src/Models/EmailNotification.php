<?php

namespace Softworx\RocXolid\Communication\Models;

use App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
// rocXolid services
use Softworx\RocXolid\Services\ViewService;
// rocXolid models
use Softworx\RocXolid\Models\AbstractCrudModel;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Contracts\Sendable;
// rocXolid communication model traits
use Softworx\RocXolid\Communication\Models\Traits\Sendable as SendableTrait;
// rocXolid common model traits
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
        if ($this->event_type) {
            $title = collect(config('rocXolid.communication.events'))->map(function($signature, $event_class) {
                return __($signature);
            })->get($this->event_type);
        } else {
            $title = '';
        }

        return sprintf('<i class="fa fa-envelope-o mr-10"></i> %s', $title);
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
        // $content = nl2br($content);

        return ViewService::render($content, $this->event->getSendableVariables());
    }

    public function getAttachments()
    {
        return [];
    }

    public function getAvailableTemplateVariables()
    {
        return App::make($this->event_type)->getSendableVariables();
    }
}