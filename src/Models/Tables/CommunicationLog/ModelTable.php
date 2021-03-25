<?php

namespace Softworx\RocXolid\Communication\Models\Tables\CommunicationLog;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
// rocXolid tables
use Softworx\RocXolid\Tables\AbstractCrudTable;
// rocXolid table contracts
use Softworx\RocXolid\Tables\Contracts\Table;
// rocXolid table column types
use Softworx\RocXolid\Tables\Columns\Type\Text;
use Softworx\RocXolid\Tables\Columns\Type\Flag;
use Softworx\RocXolid\Tables\Columns\Type\DateTime;
use Softworx\RocXolid\Tables\Columns\Type\ModelRelation;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\CommunicationLog;

class ModelTable extends AbstractCrudTable
{
    protected static $translation_param = 'communication-log';

    protected $model_relation;

    protected $log_model;

    protected $buttons = [];

    protected $columns = [
        'created_at' => [
            'type' => DateTime::class,
            'options' => [
                'label' => [
                    'title' => 'created_at'
                ],
                'wrapper' => [
                    'attributes' => [
                        'class' => 'text-center',
                    ],
                ],
            ],
        ],
        'sendable' => [
            'type' => ModelRelation::class,
            'options' => [
                'ajax' => true,
                'label' => [
                    'title' => 'sendable'
                ],
                'relation' => [
                    'name' => 'sendable',
                    'column' => 'id',
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

    public function init(): Table
    {
        if ($this->getRequest()->has('log_model')) {
            $this->setModelRelation($this->getRequest()->get('model_relation', null));

            $relation = CommunicationLog::make()->{$this->getModelRelation()}()->getRelation();
            $log_model = (new $relation())->find($this->getRequest()->get('log_model', null));

            $this->setLogModel($log_model);
        }

        return $this;
    }

    public function setModelRelation(string $model_relation = null): Table
    {
        $this->model_relation = $model_relation;

        return $this;
    }

    public function getModelRelation(): string
    {
        if (is_null($this->model_relation)) {
            throw new \RuntimeException(sprintf('Model relation not yet set to [%s]', get_class($this)));
        }

        return $this->model_relation;
    }

    public function setLogModel($log_model = null): Table
    {
        $this->log_model = $log_model;

        return $this;
    }

    public function getLogModel()
    {
        if (is_null($this->log_model)) {
            throw new \RuntimeException(sprintf('Log model not yet set to [%s]', get_class($this)));
        }

        return $this->log_model;
    }

    protected function applyIntenalFilters(): EloquentBuilder
    {
        $query = $this->getQuery()
            ->where('model_id', $this->getLogModel()->getKey())
            ->where('model_type', get_class($this->getLogModel()));

        return $query;
    }
}
