<?php

namespace Softworx\RocXolid\Communication\Models\Forms\PushNotification;

// rocXolid forms & fields
use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type as FieldType;

class SendTest extends RocXolidAbstractCrudForm
{
    /**
     * {@inheritDoc}
     */
    protected $options = [
        'method' => 'POST',
        'route-action' => 'sendTestNotification',
        'class' => 'form-horizontal form-label-left',
    ];

    /**
     * {@inheritDoc}
     */
    protected $fields = [
        'user_id' => [
            'type' => FieldType\Input::class,
            'options' => [
                'validation' => [
                    'rules' => [
                        'required',
                    ],
                ],
                'attributes' => [
                    'placeholder' => 'user_id',
                ],
            ],
        ],
    ];

    /**
     * {@inheritDoc}
     */
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

    /**
     * {@inheritDoc}
     */
    protected function adjustFieldsDefinition($fields)
    {
        return $fields;
    }
}
