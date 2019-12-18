<?php

namespace Softworx\RocXolid\Communication\Models\Forms\EmailNotification;

use Softworx\RocXolid\Forms\AbstractCrudForm as RocXolidAbstractCrudForm;
use Softworx\RocXolid\Forms\Fields\Type\WysiwygTextarea;
use Softworx\RocXolid\Forms\Fields\Type\Select;

class Update extends RocXolidAbstractCrudForm
{
    protected $options = [
        'method' => 'POST',
        'route-action' => 'update',
        'class' => 'form-horizontal form-label-left',
    ];

    protected function adjustFieldsDefinition($fields)
    {
        //$fields['content']['type'] = WysiwygTextarea::class;
        //
        $fields['action']['type'] = Select::class;
        $fields['action']['options']['placeholder']['title'] = 'action';
        $fields['action']['options']['choices'] = [
            'order_received' => 'order_received',
            'affiliate_sent' => 'affiliate_sent',
            'contact_sent' => 'contact_sent',
            'warehouse_product_stock_alert' => 'warehouse_product_stock_alert',
        ];

        return $fields;
    }
}