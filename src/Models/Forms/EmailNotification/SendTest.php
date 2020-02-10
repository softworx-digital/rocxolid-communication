<?php

namespace Softworx\RocXolid\Communication\Models\Forms\EmailNotification;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type\Email;
use Softworx\RocXolid\Forms\Fields\Type\ButtonSubmit;

class SendTest extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'sendTestNotification',
        'class' => 'form-horizontal form-label-left',
    ];

    protected $fields = [
        'email' => [
            'type' => Email::class,
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
            'type' => ButtonSubmit::class,
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

    protected function adjustFieldsDefinition($fields)
    {
        return $fields;
    }
}
