<?php

namespace Softworx\RocXolid\Communication\Repositories\CommunicationLog;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
// rocXolid repositories
use Softworx\RocXolid\Repositories\AbstractCrudRepository;
// rocXolid repository contracts
use Softworx\RocXolid\Repositories\Contracts\Repository;
// rocXolid repository column types
use Softworx\RocXolid\Repositories\Columns\Type\Text;
use Softworx\RocXolid\Repositories\Columns\Type\Flag;
use Softworx\RocXolid\Repositories\Columns\Type\DateTime;
use Softworx\RocXolid\Repositories\Columns\Type\ModelRelation;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\CommunicationLog;

class ModelRepository extends AbstractCrudRepository
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

    public function init(): Repository
    {
        if ($this->getRequest()->has('log_model')) {
            $this->setModelRelation($this->getRequest()->get('model_relation', null));

            $relation = CommunicationLog::make()->{$this->getModelRelation()}()->getRelation();
            $log_model = (new $relation())->find($this->getRequest()->get('log_model', null));

            $this->setLogModel($log_model);
        }

        return $this;
    }

    public function setModelRelation(string $model_relation = null): Repository
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

    public function setLogModel($log_model = null): Repository
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
