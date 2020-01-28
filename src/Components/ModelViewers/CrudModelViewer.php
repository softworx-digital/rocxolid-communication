<?php

namespace Softworx\RocXolid\Communication\Components\ModelViewers;

use Softworx\RocXolid\Components\ModelViewers\CrudModelViewer as RocXolidCrudModelViewer;

/**
 *
 */
class CrudModelViewer extends RocXolidCrudModelViewer
{
    protected $view_package = 'rocXolid:communication';

    protected $view_directory = '';

    protected $translation_package = 'rocXolid:communication';
}