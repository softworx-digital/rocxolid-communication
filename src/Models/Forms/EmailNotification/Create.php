<?php

namespace Softworx\RocXolid\Communication\Models\Forms\EmailNotification;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type\Hidden;
use Softworx\RocXolid\Forms\Fields\Type\WysiwygTextarea;
use Softworx\RocXolid\Forms\Fields\Type\CollectionSelect;

class Create extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'store',
        'class' => 'form-horizontal form-label-left',
    ];

    protected function adjustFieldsDefinition($fields)
    {
        $fields['event']['type'] = CollectionSelect::class;
        $fields['event']['options']['placeholder']['title'] = 'event';
        $fields['event']['options']['collection'] = collect(config('rocXolid.communication.general.events'));
        $fields['event']['options']['validation']['rules'][] = 'required';
        // $fields['event']['options']['validation']['rules'][] = 'class_exists';

        return $fields;
    }
}