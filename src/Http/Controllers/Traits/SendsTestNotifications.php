<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\Traits;

// rocXolid utils
use Softworx\RocXolid\Http\Requests\CrudRequest;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;

/**
 * Trait to send test notification.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
trait SendsTestNotifications
{
    /**
     * {@inheritDoc}
     */
    public function sendTestNotificationConfirm(CrudRequest $request, Sendable $model)//: View
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
     * {@inheritDoc}
     */
    public function sendTestNotification(CrudRequest $request, Sendable $model)//: Response - returns JSON for ajax calls
    {
        $this->authorize('sendTestNotification', $model);

        $form = $this->getForm($request, $model);

        if ($form->submit()->isValid()) {
            $model_viewer_component = $this->getModelViewerComponent($model);

            $recipient = $form->getFormField('recipient')->getValue();

            if (($sendable = $this->sendNotification($model, $recipient)) && $sendable->isSuccess()) {
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
     * @param string $recipient
     * @return \Softworx\RocXolid\Communication\Models\Contracts\Sendable
     */
    protected function sendNotification(Sendable $notification, string $recipient): Sendable
    {
        $reflection = new \ReflectionClass($notification->event_type);

        $arguments = collect();

        collect($reflection->getConstructor()->getParameters())->each(function ($argument) use (&$arguments) {
            $arguments->put($argument->getName(), $argument->getType()->getName()::factory()->make());
        });

        $event = app()->makeWith($notification->event_type, $arguments->all());

        $notification->setEvent($event);
        $notification->setRecipient($recipient);

        return $this->notificationService()->send($notification);
    }
}
