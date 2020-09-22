<?php

namespace Softworx\RocXolid\Communication\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
// rocXolid services
use Softworx\RocXolid\Rendering\Services\RenderingService;
// rocXolid models
use Softworx\RocXolid\Models\AbstractCrudModel;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;
// rocXolid communication model traits
use Softworx\RocXolid\Communication\Models\Traits\Sendable as SendableTrait;
// rocXolid common model traits
use Softworx\RocXolid\Common\Models\Traits\UserGroupAssociatedWeb;
use Softworx\RocXolid\Common\Models\Traits\HasWeb;

/**
 * Sendable e-mail notification.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Admin
 * @version 1.0.0
 */
class EmailNotification extends AbstractCrudModel implements Sendable
{
    use SoftDeletes;
    use HasWeb;
    // use UserGroupAssociatedWeb; // @todo: "hotfixed"
    use SendableTrait;

    protected $fillable = [
        'event_type',
        'is_enabled',
        'is_can_be_turned_off',
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

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string
    {
        if ($this->event_type) {
            $title = collect(config('rocXolid.communication.events'))->map(function ($signature, $event_class) {
                return __($signature);
            })->get($this->event_type);
        } else {
            $title = '';
        }

        return sprintf('<i class="fa fa-envelope-o mr-10"></i> %s', $title);
    }

    /**
     * {@inheritDoc}
     */
    public function getSender($flat = false)
    {
        if ($flat) {
            return sprintf('%s <%s>', $this->sender_name, $this->sender_email);
        }

        return [
            'email' => $this->sender_email,
            'name' => $this->sender_name,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getSubject(): string
    {
        return RenderingService::render($this->subject, $this->event->getSendableVariables());
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipient(string $recipient): Sendable
    {
        $this->recipient_email = $recipient;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipients(): Collection
    {
        if ($this->recipient_email) {
            return collect($this->recipient_email);
        } else {
            return $this->event->getRecipients();
        }
    }

    /**
     * Get notification attachments.
     *
     * @return array
     */
    public function getAttachments(): array
    {
        return [];
    }

    /**
     * Compile the content as blade template.
     *
     * @return string
     */
    protected function renderContent(): string
    {
        $content = str_replace('-&gt;', '->', $this->content);
        // $content = nl2br($content);

        return RenderingService::render($content, $this->event->getSendableVariables());
    }
}
