<?php

namespace Softworx\RocXolid\Communication\Models\Tables\CommunicationLog;

use Softworx\RocXolid\Tables\AbstractCrudTable;
use Softworx\RocXolid\Tables\Columns\Type\Text;
use Softworx\RocXolid\Tables\Columns\Type\Flag;
use Softworx\RocXolid\Tables\Columns\Type\ModelRelation;

class Index extends AbstractCrudTable
{
    protected static $translation_param = 'communication-log';

    protected $columns = [
        'sendable_id' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'sendable_id'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'sendable_type' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'sendable_type'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'action' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'action'
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
        'recipient' => [
            'type' => Text::class,
            'options' => [
                'label' => [
                    'title' => 'recipient'
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
        'is_success' => [
            'type' => Flag::class,
            'options' => [
                'label' => [
                    'title' => 'is_success'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
    ];
}
