<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\EmailNotification;

// rocXolid communication contracts
use Softworx\RocXolid\Communication\Http\Contracts\Controllers\NotificationSender;
// rocXolid communication controllers
use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
// rocXolid communication components
use Softworx\RocXolid\Communication\Components\ModelViewers\EmailNotificationViewer;
// rocXolid communication controller traits
use Softworx\RocXolid\Communication\Http\Controllers\Traits\SendsTestNotifications;
// rocXolid communication services
use Softworx\RocXolid\Communication\Services;

/**
 * E-mail notification CRUD controller.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class Controller extends AbstractCrudController implements NotificationSender
{
    use SendsTestNotifications;

    protected static $model_viewer_type = EmailNotificationViewer::class;

    /**
     * {@inheritDoc}
     */
    protected $form_mapping = [
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update',
        'update' => 'update',
        'edit.composition' => 'update-composition',
        'update.composition' => 'update-composition',
        'sendTestNotificationConfirm' => 'send-test',
        'sendTestNotification' => 'send-test',
    ];

    public function notificationService(): Services\Contracts\NotificationService
    {
        return app(Services\EmailService::class);
    }
}
