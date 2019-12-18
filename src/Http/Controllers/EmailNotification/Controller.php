<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\EmailNotification;

use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
use Softworx\RocXolid\Communication\Models\EmailNotification;
use Softworx\RocXolid\Communication\Repositories\EmailNotification\Repository;

class Controller extends AbstractCrudController
{
    protected static $model_class = EmailNotification::class;

    protected static $repository_class = Repository::class;
}