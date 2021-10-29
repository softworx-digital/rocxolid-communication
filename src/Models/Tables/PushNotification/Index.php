<?php

namespace Softworx\RocXolid\Communication\Models\Tables\PushNotification;

// rocXolid tables & types
use Softworx\RocXolid\Tables\AbstractCrudTable;
use Softworx\RocXolid\Tables\Filters\Type as FilterType;
use Softworx\RocXolid\Tables\Columns\Type as ColumnType;
use Softworx\RocXolid\Tables\Buttons\Type as ButtonType;

/**
 * Default PushNotification model table.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class Index extends AbstractCrudTable
{
    protected $columns = [
        /*
        'model' => [
            'type' => ColumnType\ModelRelation::class,
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
            'type' => ColumnType\SwitchFlag::class,
            'options' => [
                'label' => [
                    'title' => 'is_enabled'
                ],
            ],
        ],
        'is_can_be_turned_off' => [
            'type' => ColumnType\Flag::class,
            'options' => [
                'label' => [
                    'title' => 'is_can_be_turned_off'
                ],
            ],
        ],
        'web_id' => [
            'type' => ColumnType\ModelRelation::class,
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
        'language_id' => [
            'type' => ColumnType\ModelRelation::class,
            'options' => [
                'ajax' => true,
                'label' => [
                    'title' => 'language_id'
                ],
                'relation' => [
                    'name' => 'language',
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
            'type' => ColumnType\Text::class,
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
        'config' => [
            'type' => ColumnType\Text::class,
            'options' => [
                'label' => [
                    'title' => 'config'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'recipient_user_id' => [
            'type' => ColumnType\Text::class,
            'options' => [
                'label' => [
                    'title' => 'recipient_user_id'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'heading' => [
            'type' => ColumnType\Text::class,
            'options' => [
                'label' => [
                    'title' => 'heading'
                ],
            ],
        ],
    ];

    protected $buttons = [
        'edit' => [
            'type' => ButtonType\ButtonAnchor::class,
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
            'type' => ButtonType\ButtonAnchor::class,
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
            'type' => ButtonType\ButtonAnchor::class,
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
            'type' => ButtonType\ButtonAnchor::class,
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

        $columns['config']['options']['translate'] = collect([ 'default', 'internal' ])->mapWithKeys(function (string $key) {
            return [
                $key => $this->getController()->translate(sprintf('choice.config.%s', $key))
            ];
        });

        return $columns;
    }
}
