<?php

namespace Softworx\RocXolid\Communication\Models\Forms\PushNotification;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type\WysiwygTextarea;
use Softworx\RocXolid\Forms\Fields\Type\CollectionSelect;
use Softworx\RocXolid\Forms\Fields\Type\Tagsinput;

class Update extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'update',
        'class' => 'form-horizontal form-label-left',
    ];

    protected function adjustFieldsDefinition($fields)
    {
        $fields['event_type']['type'] = CollectionSelect::class;
        $fields['event_type']['options']['placeholder']['title'] = 'event_type';
        $fields['event_type']['options']['validation']['rules'][] = 'required';
        $fields['event_type']['options']['validation']['rules'][] = 'class_exists';
        $fields['event_type']['options']['collection'] = collect(config('rocXolid.communication.events'))->map(function ($signature, $event_class) {
            return __($signature);
        });

        $fields['recipient_email']['type'] = Tagsinput::class;

        $fields['subject']['options']['validation']['rules'][] = sprintf('blade_template:%s,%s', get_class($this->getModel()), $this->getModel()->getKey());

        $fields['content']['type'] = WysiwygTextarea::class;
        $fields['content']['options']['validation']['rules'][] = sprintf('blade_template:%s,%s', get_class($this->getModel()), $this->getModel()->getKey());

        // unset($fields['subject']);
        // unset($fields['content']);

        return $fields;
    }
}
