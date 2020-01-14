<?php

namespace Softworx\RocXolid\Communication\Models\Forms\CommunicationLog;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;

class Update extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'update',
        'class' => 'form-horizontal form-label-left',
    ];
}
