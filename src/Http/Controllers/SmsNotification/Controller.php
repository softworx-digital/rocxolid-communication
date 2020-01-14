<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\SmsNotification;

use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
use Softworx\RocXolid\Communication\Models\SmsNotification;
use Softworx\RocXolid\Communication\Repositories\SmsNotification\Repository;

class Controller extends AbstractCrudController
{
    protected static $model_class = SmsNotification::class;

    protected static $repository_class = Repository::class;
}
