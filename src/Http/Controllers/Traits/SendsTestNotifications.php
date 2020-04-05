<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\Traits;

// rocXolid utils
use Softworx\RocXolid\Http\Requests\CrudRequest;
// rocXolid model contracts
use Softworx\RocXolid\Models\Contracts\Crudable;
// rocXolid form components
use Softworx\RocXolid\Components\Forms\CrudForm as CrudFormComponent;
// rocXolid communication services
use Softworx\RocXolid\Communication\Services\EmailService;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;

/**
 * Trait to send test notification.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid
 * @version 1.0.0
 */
trait SendsTestNotifications
{
    /**
     * Display the dialog to enter testing e-mail.
     *
     * @Softworx\RocXolid\Annotations\AuthorizedAction(policy_ability_group="execute",policy_ability="sendTestNotification")
     * @param \Softworx\RocXolid\Http\Requests\CrudRequest $request Incoming request.
     * @param \Softworx\RocXolid\Models\Contracts\Crudable $model
     */
    public function sendTestNotificationConfirm(CrudRequest $request, Crudable $model)//: View
    {
        $this->authorize('sendTestNotification', $model);

        $model_viewer_component = $this->getModelViewerComponent(
            $model,
            $this->getFormComponent($this->getForm($request, $model))
        );

        if ($request->ajax()) {
            return $this->response
                ->modal($model_viewer_component->fetch('modal.send-test-confirm'))
                ->get();
        } else {
            return $this
                ->getDashboard()
                ->setModelViewerComponent($model_viewer_component)
                ->render('model', [
                    'model_viewer_template' => 'send-test-confirm'
                ]);
        }
    }

    /**
     * Send test notification.
     *
     * @Softworx\RocXolid\Annotations\AuthorizedAction(policy_ability_group="execute",policy_ability="sendTestNotification")
     * @param \Softworx\RocXolid\Http\Requests\CrudRequest $request Incoming request.
     * @param \Softworx\RocXolid\Models\Contracts\Crudable $model
     */
    public function sendTestNotification(CrudRequest $request, Crudable $model)//: Response - returns JSON for ajax calls
    {
        $this->authorize('sendTestNotification', $model);

        $form = $this->getForm($request, $model);

        if ($form->submit()->isValid()) {
            $model_viewer_component = $this->getModelViewerComponent($model);

            $email = $form->getFormField('email')->getValue();

            if ($sent = $this->sendNotification($model, $email)) {
                $this->response
                    ->notifySuccess($model_viewer_component->translate('text.sending-success'))
                    ->modalClose($model_viewer_component->getDomId('modal-send-test', $model->getKey()));
            } else {
                $this->response
                    ->notifyError($model_viewer_component->translate('text.sending-failure'));
            }

            return $this->response->get();
        } else {
            return $this->errorResponse($request, $model, $form, 'sendTestNotification');
        }
    }

    /**
     * Create necessary mocks and send the notification.
     *
     * @param \Softworx\RocXolid\Communication\Models\Contracts\Sendable $notification
     * @param string $email
     * @return \Softworx\RocXolid\Communication\Models\Contracts\Sendable
     */
    protected function sendNotification(Sendable $notification, string $email): Sendable
    {
        $reflection = new \ReflectionClass($notification->event_type);

        $arguments = collect();

        collect($reflection->getConstructor()->getParameters())->each(function ($argument) use (&$arguments) {
            $arguments->put($argument->getName(), factory($argument->getType()->getName())->make());
        });

        $event = app()->makeWith($notification->event_type, $arguments->all());

        $notification->setEvent($event);
        $notification->setRecipient($email);

        return (new EmailService($notification))->send();
    }
}
