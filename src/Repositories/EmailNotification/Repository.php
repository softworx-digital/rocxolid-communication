<?php

namespace Softworx\RocXolid\Communication\Repositories\EmailNotification;

use Softworx\RocXolid\Repositories\AbstractCrudRepository;
use Softworx\RocXolid\Repositories\Columns\Type\Text;
use Softworx\RocXolid\Repositories\Columns\Type\Flag;
use Softworx\RocXolid\Repositories\Columns\Type\ModelRelation;
use Softworx\RocXolid\Repositories\Columns\Type\ButtonAnchor;

class Repository extends AbstractCrudRepository
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
            'type' => Flag::class,
            'options' => [
                'label' => [
                    'title' => 'is_enabled'
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
                'policy-ability' => 'edit',
                'policy-ability-group' => 'write',
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
                'policy-ability' => 'edit',
                'policy-ability-params' => [
                    '_section' => 'composition',
                ],
                'policy-ability-group' => 'write',
            ],
        ],*//*
        'delete-ajax' => [
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
                'policy-ability' => 'destroyConfirm',
                'policy-ability-group' => 'write',
            ],
        ],*/
    ];

    protected function adjustColumnsDefinition($columns)
    {
        $columns['event_type']['options']['translate'] = collect(config('rocXolid.communication.events'))->map(function ($signature, $event_class) {
            return __($signature);
        });

        return $columns;
    }
}
