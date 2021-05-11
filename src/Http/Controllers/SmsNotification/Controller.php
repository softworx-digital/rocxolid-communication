<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\SmsNotification;

// rocXolid communication contracts
use Softworx\RocXolid\Communication\Http\Contracts\Controllers\NotificationSender;
// rocXolid communication controllers
use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
// rocXolid communication controller traits
use Softworx\RocXolid\Communication\Http\Controllers\Traits\SendsTestNotifications;
// rocXolid communication services
use Softworx\RocXolid\Communication\Services;

/**
 * SMS notification CRUD controller.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class Controller extends AbstractCrudController implements NotificationSender
{
    use SendsTestNotifications;

    public function notificationService(): Services\Contracts\NotificationService
    {
        return app(Services\SmsService::class);
    }
}
