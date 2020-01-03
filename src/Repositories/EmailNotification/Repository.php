<?php

namespace Softworx\RocXolid\Communication\Repositories\EmailNotification;

use Softworx\RocXolid\Repositories\AbstractCrudRepository;
use Softworx\RocXolid\Repositories\Columns\Type\Text;
use Softworx\RocXolid\Repositories\Columns\Type\Flag;
use Softworx\RocXolid\Repositories\Columns\Type\ModelRelation;

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
        'is_enabled' => [
            'type' => Flag::class,
            'options' => [
                'label' => [
                    'title' => 'is_enabled'
                ],
            ],
        ],
    ];
}