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
// rocXolid common model traits
use Softworx\RocXolid\Common\Models\Traits as CommonTraits;

/**
 * Sendable e-mail notification.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class PushNotification extends AbstractCrudModel implements Sendable
{
    use SoftDeletes;
    use CommonTraits\HasWeb;
    use CommonTraits\HasLanguage;
    use CommonTraits\HasImage;
    // use CommonTraits\HasLocalization;
    // use CommonTraits\UserGroupAssociatedWeb;
    use Traits\Sendable;

    protected $fillable = [
        'language_id',
        'config',
        'event_type',
        'is_enabled',
        'is_can_be_turned_off',
        'recipient_user_id',
        'heading',
        'subtitle',
        'url',
        'content',
        'description'
    ];

    protected $relationships = [
        // 'web',
        'language',
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

        return sprintf('<i class="fa fa-bell-o mr-10"></i> %s', $title);
    }

    /**
     * {@inheritDoc}
     */
    public function getSender($flat = false)
    {
        return config('app.name');
    }

    /**
     * {@inheritDoc}
     */
    public function setRecipient(string $recipient): Sendable
    {
        $this->recipient_user_id = $recipient;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRecipients(): Collection
    {
        if ($this->recipient_user_id) {
            return collect(explode(',', $this->recipient_user_id))->filter(function (string $player_id) {
                return (bool)$player_id && !in_array($player_id, [ 'null' ]);
            });
        } else {
            return $this->event->getRecipients($this)->filter(function (string $player_id) {
                return (bool)$player_id && !in_array($player_id, [ 'null' ]);
            });
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getSubject(): string
    {
        return RenderingService::render($this->heading, $this->event->getSendableVariables());
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): ?array
    {
        return $this->event->getData();
    }

    /**
     * Get notification subtitle.
     *
     * @return string|null
     */
    public function getSubtitle(): ?string
    {
        return !$this->subtitle ?: RenderingService::render($this->subtitle, $this->event->getSendableVariables());
    }

    /**
     * Get notification URL.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
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

        return strip_tags(RenderingService::render($content, $this->event->getSendableVariables()));
    }
}
