<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\EmailNotification;

use Softworx\RocXolid\Models\Contracts\Crudable as CrudableModel;
use Softworx\RocXolid\Components\ModelViewers\CrudModelViewer as CrudModelViewerComponent;
use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
use Softworx\RocXolid\Communication\Models\EmailNotification;
use Softworx\RocXolid\Communication\Repositories\EmailNotification\Repository;
use Softworx\RocXolid\Communication\Components\ModelViewers\EmailNotificationViewer;

class Controller extends AbstractCrudController
{
    protected static $model_class = EmailNotification::class;

    protected static $repository_class = Repository::class;

    protected $form_mapping = [
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update',
        'update' => 'update',
        'edit.composition' => 'update-composition',
        'update.composition' => 'update-composition',
    ];

    public function getModelViewerComponent(CrudableModel $model): CrudModelViewerComponent
    {
        return EmailNotificationViewer::build($this, $this)
            ->setModel($model)
            ->setController($this);
    }
}