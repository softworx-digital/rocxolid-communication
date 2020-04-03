<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\EmailNotification;

// rocXolid models
use Softworx\RocXolid\Models\Contracts\Crudable as CrudableModel;
// rocXolid components
use Softworx\RocXolid\Components\ModelViewers\CrudModelViewer as CrudModelViewerComponent;
// rocXolid communication controllers
use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\EmailNotification;
// rocXolid communication repositories
use Softworx\RocXolid\Communication\Repositories\EmailNotification\Repository;
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

    /**
     * {@inheritDoc}
     */


    /**
     * {@inheritDoc}
     */
    protected static $repository_class = Repository::class;

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

    /**
     * {@inheritDoc}
     */
    public function getModelViewerComponent(CrudableModel $model): CrudModelViewerComponent
    {
        return EmailNotificationViewer::build($this, $this)
            ->setModel($model)
            ->setController($this);
    }
}
