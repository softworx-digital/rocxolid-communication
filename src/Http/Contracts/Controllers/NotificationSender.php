<?php

namespace Softworx\RocXolid\Communication\Http\Contracts\Controllers;

// rocXolid utility
use Softworx\RocXolid\Http\Requests\CrudRequest;
// rocXolid communication model contracts
use Softworx\RocXolid\Communication\Models\Contracts\Sendable;
// rocXolid communication services
use Softworx\RocXolid\Communication\Services\Contracts\NotificationService;

/**
 * Enables controller to send notification per request.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
interface NotificationSender
{
    /**
     * Display the dialog to enter testing e-mail.
     *
     * @Softworx\RocXolid\Annotations\AuthorizedAction(policy_ability_group="execute",policy_ability="sendTestNotification")
     * @param \Softworx\RocXolid\Http\Requests\CrudRequest $request Incoming request.
     * @param \Softworx\RocXolid\Communication\Models\Contracts\Sendable $notification
     */
    public function sendTestNotificationConfirm(CrudRequest $request, Sendable $notification);//: View

    /**
     * Send test notification.
     *
     * @Softworx\RocXolid\Annotations\AuthorizedAction(policy_ability_group="execute",policy_ability="sendTestNotification")
     * @param \Softworx\RocXolid\Http\Requests\CrudRequest $request Incoming request.
     * @param \Softworx\RocXolid\Communication\Models\Contracts\Sendable $notification
     */
    public function sendTestNotification(CrudRequest $request, Sendable $notification);//: Response - returns JSON for ajax calls

    /**
     * Obtain associated notification service.
     *
     * @return \Softworx\RocXolid\Communication\Services\Contracts\NotificationService
     */
    public function notificationService(): NotificationService;
}
