<?php

namespace Softworx\RocXolid\Communication\Models\Forms\EmailNotification;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type\WysiwygTextarea;
use Softworx\RocXolid\Forms\Fields\Type\CollectionSelect;
use Softworx\RocXolid\Forms\Fields\Type\Tagsinput;

class Create extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'store',
        'class' => 'form-horizontal form-label-left',
    ];

    protected function adjustFieldsDefinition($fields)
    {
        $fields['event_type']['type'] = CollectionSelect::class;
        $fields['event_type']['options']['placeholder']['title'] = 'event_type';
        $fields['event_type']['options']['validation']['rules'][] = 'required';
        $fields['event_type']['options']['validation']['rules'][] = 'class_exists';
        $fields['event_type']['options']['collection'] = collect(config('rocXolid.communication.events'))->map(function($signature, $event_class) {
            return __($signature);
        });

        unset($fields['sender_email']);
        unset($fields['sender_name']);
        unset($fields['recipient_email']);
        unset($fields['cc_recipient_email']);
        unset($fields['bcc_recipient_email']);
        unset($fields['subject']);
        unset($fields['content']);

        return $fields;
    }
}