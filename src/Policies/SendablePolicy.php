<?php

namespace Softworx\RocXolid\Communication\Policies;

// rocXolid utils
use Softworx\RocXolid\Http\Requests\CrudRequest;
// rocXolid model contracts
use Softworx\RocXolid\Models\Contracts\Crudable;
// rocXolid user management contracts
use Softworx\RocXolid\UserManagement\Models\Contracts\HasAuthorization;
// rocXolid user management policies
use Softworx\RocXolid\UserManagement\Policies\CrudPolicy;

/**
 * Sendable controller/model policy.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\UserManagement
 * @version 1.0.0
 */
class SendablePolicy extends CrudPolicy
{
    /**
     * Determine whether the user can send test notifications.
     *
     * @param \Softworx\RocXolid\UserManagement\Models\Contracts\HasAuthorization $user
     * @param \Softworx\RocXolid\Models\Contracts\Crudable $model
     * @return bool
     */
    public function sendTestNotification(HasAuthorization $user, Crudable $model): bool
    {
        return $this->checkPermissions($user, 'sendTestNotification', get_class($model));
    }
}
