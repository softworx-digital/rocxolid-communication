<?php

namespace Softworx\RocXolid\Communication\Models\Forms\EmailNotification;

// rocXolid forms & fields
use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type as FieldType;

class SendTest extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'sendTestNotification',
        'class' => 'form-horizontal form-label-left',
    ];

    protected $fields = [
        'recipient' => [
            'type' => FieldType\Email::class,
            'options' => [
                'validation' => [
                    'rules' => [
                        'required',
                        'email',
                    ],
                ],
                'attributes' => [
                    'placeholder' => 'email',
                ],
            ],
        ],
    ];

    protected $buttons = [
        'submit' => [
            'type' => FieldType\ButtonSubmit::class,
            'options' => [
                'ajax' => true,
                'label' => [
                    'title' => 'send-test',
                ],
                'attributes' => [
                    'class' => 'btn btn-primary',
                ],
            ],
        ],
    ];

    protected function adjustFieldsDefinition(array $fields): array
    {
        return $fields;
    }
}
