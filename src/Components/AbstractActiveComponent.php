<?php

namespace Softworx\RocXolid\Communication\Components;

use Softworx\RocXolid\Components\AbstractActiveComponent as RocXolidAbstractActiveComponent;

abstract class AbstractActiveComponent extends RocXolidAbstractActiveComponent
{
    protected $view_package = 'rocXolid:communication';

    protected $view_directory = '';

    protected $translation_package = 'rocXolid:communication';
}
