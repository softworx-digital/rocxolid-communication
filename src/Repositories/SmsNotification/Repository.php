<?php

namespace Softworx\RocXolid\Communication\Repositories\SmsNotification;

use Softworx\RocXolid\Repositories\AbstractCrudRepository;
use Softworx\RocXolid\Repositories\Columns\Type\Text;
use Softworx\RocXolid\Repositories\Columns\Type\ModelRelation;

class Repository extends AbstractCrudRepository
{
    protected static $translation_param = 'sms-system-notification';

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
        'event' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'event'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'sender' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'sender'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'recipient_phone_number' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'recipient_phone_number'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'content' => [
            'type' => Text::class,
            'options' => [
                'shorten' => 200,
                'label' => [
                    'title' => 'content'
                ],
            ],
        ],
    ];
}