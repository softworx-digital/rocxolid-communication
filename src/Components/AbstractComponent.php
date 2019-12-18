<?php

namespace Softworx\RocXolid\Communication\Components;

use Softworx\RocXolid\Components\AbstractComponent as RocXolidAbstractComponent;

abstract class AbstractComponent extends RocXolidAbstractComponent
{
    protected $view_package = 'rocXolid:communication';

    protected $view_directory = '';

    protected $translation_package = 'rocXolid:communication';
}