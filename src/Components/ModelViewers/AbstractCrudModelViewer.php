<?php

namespace Softworx\RocXolid\Communication\Components\ModelViewers;

use Softworx\RocXolid\Components\ModelViewers\CrudModelViewer as RocXolidCrudModelViewer;

/**
 *
 */
abstract class AbstractCrudModelViewer extends RocXolidCrudModelViewer
{
    protected $view_package = 'rocXolid:communication';
}
