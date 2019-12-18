<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\CommunicationLog;

use Softworx\RocXolid\Http\Requests\CrudRequest;
use Softworx\RocXolid\Components\Tables\CrudTable as CrudTableComponent;
use Softworx\RocXolid\Components\ModelViewers\CrudModelViewer as CrudModelViewerComponent;
use Softworx\RocXolid\Models\Contracts\Crudable as CrudableModel;
use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
use Softworx\RocXolid\Communication\Models\CommunicationLog;
use Softworx\RocXolid\Communication\Repositories\CommunicationLog\Repository;
use Softworx\RocXolid\Communication\Repositories\CommunicationLog\ModelRepository;
use Softworx\RocXolid\Communication\Components\ModelViewers\CommunicationLogViewer;

class Controller extends AbstractCrudController
{
    protected static $model_class = CommunicationLog::class;

    protected static $repository_class = Repository::class;

    protected static $repository_param_class = [
        'model-log' => ModelRepository::class,
    ];

    protected $repository_mapping = [
        'modelLog' => 'model-log',
    ];

    public function getCommunicationLogViewerComponent(CrudableModel $log_model): CrudModelViewerComponent
    {
        return (new CommunicationLogViewer())
            ->setModel($log_model)
            ->setController($this);
    }

    public function modelLog(CrudRequest $request, $relation, $id)
    {
        $relation = CommunicationLog::make()->$relation()->getRelation();
        $log_model = (new $relation())->find($id);
        $repository = $this->getRepository($this->getRepositoryParam($request));
        $model_viewer_component = $this->getCommunicationLogViewerComponent($log_model);

        $repository
            ->setLogModel($log_model)
            ->setModelRelation($relation);

        $repository_component = (new CrudTableComponent())->setRepository($repository);

        return $this->response
            ->modal($model_viewer_component->fetch('modal.log', [ 'log_model' => $log_model, 'repository_component' => $repository_component ]))
            ->get();
    }
}