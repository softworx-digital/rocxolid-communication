<?php

namespace Softworx\RocXolid\Communication\Models;

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
        'event',
        'sender_email',
        'sender_name',
        'recipient_email',
        'subject',
        'content',
        'description'
    ];

    protected $relationships = [
        // 'web',
    ];

    protected $data = null;

    protected $items = null;

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getData($key = null)
    {
        return !is_null($key) ? $this->data[$key] : $this->data;
    }

    public function getSendingModel($action)
    {
        switch ($action)
        {
            case 'warehouse_product_stock':
                return $this->getWarehouse();
            default:
                throw new \InvalidArgumentException(sprintf('Unsupported action [%s] for sending model retrieval', $action));
        }
    }

    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    public function getItems()
    {
        if (is_null($this->items))
        {
            throw new \RuntimeException(sprintf('Items not yet set to [%s]', get_class($this)));
        }

        return $this->items;
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

    public function getRecipient(): string
    {
        return $this->recipient_email;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getAttachments()
    {
        return [];
    }

    public function getTitle()
    {
        return '<i class="fa fa-envelope-o fa-2x fa-fw"></i>';
    }

    protected function renderContent(): string
    {
        $content = str_replace('-&gt;', '->', $this->content);

        /*
        return ViewService::render($content, [
            'items' => $this->getItems(),
            'warehouse' => $this->getWarehouse(),
        ]);
        */
        return ViewService::render($content, [ 'mail' => $this ]);
    }
}