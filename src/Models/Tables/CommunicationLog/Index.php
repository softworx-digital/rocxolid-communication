<?php

namespace Softworx\RocXolid\Communication\Models\Tables\CommunicationLog;

// rocXolid tables & types
use Softworx\RocXolid\Tables\AbstractCrudTable;
use Softworx\RocXolid\Tables\Filters\Type as FilterType;
use Softworx\RocXolid\Tables\Columns\Type as ColumnType;
use Softworx\RocXolid\Tables\Buttons\Type as ButtonType;

/**
 * Default CommunicationLog model table.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class Index extends AbstractCrudTable
{
    protected $columns = [
        'sendable_id' => [
            'type' => ColumnType\Text::class,
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
            'type' => ColumnType\Text::class,
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
            'type' => ColumnType\Text::class,
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
            'type' => ColumnType\Text::class,
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
            'type' => ColumnType\Text::class,
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
            'type' => ColumnType\Text::class,
            'options' => [
                'label' => [
                    'title' => 'subject'
                ],
            ],
        ],
        'is_success' => [
            'type' => ColumnType\Flag::class,
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
