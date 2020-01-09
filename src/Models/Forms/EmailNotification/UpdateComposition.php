<?php

namespace Softworx\RocXolid\Communication\Models\Forms\EmailNotification;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type\Input;
use Softworx\RocXolid\Forms\Fields\Type\WysiwygTextarea;

class UpdateComposition extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'update',
        'class' => 'form-horizontal form-label-left',
        'section' => 'composition',
    ];

    protected $fields = [
        'subject' => [
            'type' => Input::class,
            'options' => [
                'label' => [
                    'title' => 'subject',
                ],
                'validation' => [
                    'rules' => [
                        'required',
                    ],
                ],
            ],
        ],
        'content' => [
            'type' => WysiwygTextarea::class,
            'options' => [
                'label' => [
                    'title' => 'subject',
                ],
                'validation' => [
                    'rules' => [
                        'required',
                    ],
                ],
            ],
        ],
    ];

    protected function adjustFieldsDefinition($fields)
    {
        return $fields;
    }
}