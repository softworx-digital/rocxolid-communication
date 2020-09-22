<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\EmailNotification;

// rocXolid communication controllers
use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
// rocXolid communication components
use Softworx\RocXolid\Communication\Components\ModelViewers\EmailNotificationViewer;
// rocXolid communication controller traits
use Softworx\RocXolid\Communication\Http\Controllers\Traits\SendsTestNotifications;

/**
 * E-mail notification CRUD controller.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Admin
 * @version 1.0.0
 */
class Controller extends AbstractCrudController
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
}
