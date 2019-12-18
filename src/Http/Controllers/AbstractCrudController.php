<?php

namespace Softworx\RocXolid\Communication\Http\Controllers;

use Softworx\RocXolid\Http\Controllers\AbstractCrudController as RocXolidAbstractCrudController;
use Softworx\RocXolid\Communication\Components\Dashboard\Crud as CrudDashboard;

abstract class AbstractCrudController extends RocXolidAbstractCrudController
{
    protected static $dashboard_class = CrudDashboard::class;
}