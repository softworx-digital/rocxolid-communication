<?php

namespace Softworx\RocXolid\Communication\Models\Forms\PushNotification;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type as FieldType;

class Update extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'update',
        'class' => 'form-horizontal form-label-left',
    ];

    protected function adjustFieldsDefinition($fields)
    {
        $fields['config']['type'] = FieldType\CollectionSelect::class;
        $fields['config']['options']['placeholder']['title'] = 'config';
        $fields['config']['options']['collection'] = collect([ 'default', 'internal' ])->mapWithKeys(function (string $key) {
            return [
                $key => $this->getController()->translate(sprintf('choice.config.%s', $key))
            ];
        });

        // @todo macro
        $fields['event_type']['type'] = FieldType\CollectionSelect::class;
        $fields['event_type']['options']['placeholder']['title'] = 'event_type';
        $fields['event_type']['options']['validation']['rules'][] = 'required';
        $fields['event_type']['options']['validation']['rules'][] = 'class_exists';
        $fields['event_type']['options']['collection'] = collect(config('rocXolid.communication.events'))
            ->filter(function (string $signature, string $type) {
                return $type::getNotificationTypes()->contains(get_class($this->getModel()));
            })
            ->map(function (string $signature, string $type) {
                return __($signature);
            });

        // $fields['recipient_email']['type'] = Tagsinput::class;

        $fields['heading']['options']['validation']['rules'][] = sprintf('blade_template:%s,%s', get_class($this->getModel()), $this->getModel()->getKey());

        // $fields['content']['type'] = WysiwygTextarea::class;
        $fields['content']['options']['validation']['rules'][] = sprintf('blade_template:%s,%s', get_class($this->getModel()), $this->getModel()->getKey());

        // unset($fields['subject']);
        // unset($fields['content']);

        return $fields;
    }
}
