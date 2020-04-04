<?php

namespace Softworx\RocXolid\Communication\Models\Tables\EmailNotification;

// rocXolid tables
use Softworx\RocXolid\Tables\AbstractCrudTable;
// rocXolid table columns
use Softworx\RocXolid\Tables\Columns\Type\Text;
use Softworx\RocXolid\Tables\Columns\Type\Flag;
use Softworx\RocXolid\Tables\Columns\Type\SwitchFlag;
use Softworx\RocXolid\Tables\Columns\Type\ModelRelation;
// rocXolid table buttons
use Softworx\RocXolid\Tables\Buttons\Type\ButtonAnchor;

class Index extends AbstractCrudTable
{
    protected static $translation_param = 'email-system-notification';

    protected $columns = [
        /*
        'model' => [
            'type' => ModelRelation::class,
            'options' => [
                'ajax' => true,
                'label' => [
                    'title' => 'attached'
                ],
                'relation' => [
                    'name' => 'emailable',
                    'column' => 'title',
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        */
        'is_enabled' => [
            'type' => SwitchFlag::class,
            'options' => [
                'label' => [
                    'title' => 'is_enabled'
                ],
            ],
        ],
        'is_can_be_turned_off' => [
            'type' => Flag::class,
            'options' => [
                'label' => [
                    'title' => 'is_can_be_turned_off'
                ],
            ],
        ],
        'web_id' => [
            'type' => ModelRelation::class,
            'options' => [
                'ajax' => true,
                'label' => [
                    'title' => 'web_id'
                ],
                'relation' => [
                    'name' => 'web',
                    'column' => 'title',
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'event_type' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'event_type'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
                // 'translate' => ..., // adjusted
            ],
        ],
        'sender_email' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'sender_email'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'sender_name' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'sender_name'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'recipient_email' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'recipient_email'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'subject' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'subject'
                ],
            ],
        ],
    ];

    protected $buttons = [
        'edit' => [
            'type' => ButtonAnchor::class,
            'options' => [
                'label' => [
                    'icon' => 'fa fa-pencil',
                ],
                'attributes' => [
                    'class' => 'btn btn-primary btn-sm margin-right-no',
                    'title-key' => 'edit',
                ],
                'policy-ability' => 'update',
                'action' => 'edit',
            ],
        ],
        'send-test' => [
            'type' => ButtonAnchor::class,
            'options' => [
                'ajax' => true,
                'label' => [
                    'icon' => 'fa fa-paper-plane-o',
                ],
                'attributes' => [
                    'class' => 'btn btn-info btn-sm margin-right-no',
                    'title-key' => 'send-test',
                ],
                'policy-ability' => 'sendTestNotification',
                'action' => 'sendTestNotificationConfirm',
            ],
        ],/*
        'compose' => [
            'type' => ButtonAnchor::class,
            'options' => [
                'label' => [
                    'icon' => 'fa fa-object-group',
                ],
                'attributes' => [
                    'class' => 'btn btn-primary btn-sm margin-right-no',
                    'title-key' => 'compose',
                ],
                'policy-ability' => 'update',
                'action' => 'edit',
                'route-params' => [
                    '_section' => 'composition',
                ],
            ],
        ],*/
        'delete' => [
            'type' => ButtonAnchor::class,
            'options' => [
                'ajax' => true,
                'label' => [
                    'icon' => 'fa fa-trash',
                ],
                'attributes' => [
                    'class' => 'btn btn-danger btn-sm margin-right-no',
                    'title-key' => 'delete',
                ],
                'policy-ability' => 'delete',
                'action' => 'destroyConfirm',
            ],
        ],
    ];

    protected function adjustColumnsDefinition($columns)
    {
        $columns['event_type']['options']['translate'] = collect(config('rocXolid.communication.events'))->map(function ($signature, $event_class) {
            return __($signature);
        });

        return $columns;
    }
}