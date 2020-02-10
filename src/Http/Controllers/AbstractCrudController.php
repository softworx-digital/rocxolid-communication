<?php

namespace Softworx\RocXolid\Communication\Http\Controllers;

// rocXolid controllers
use Softworx\RocXolid\Http\Controllers\AbstractCrudController as RocXolidAbstractCrudController;
// rocXolid admin components
use Softworx\RocXolid\Admin\Components\Dashboard\Crud as CrudDashboard;

/**
 * Communication CRUD controller.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Admin
 * @version 1.0.0
 */
abstract class AbstractCrudController extends RocXolidAbstractCrudController
{
    /**
     * {@inheritDoc}
     */
    protected static $dashboard_class = CrudDashboard::class;

    /**
     * {@inheritDoc}
     */
    protected $translation_package = 'rocXolid:communication';
}
