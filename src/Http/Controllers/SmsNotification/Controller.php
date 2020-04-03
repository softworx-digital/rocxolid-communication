<?php

namespace Softworx\RocXolid\Communication\Http\Controllers\SmsNotification;

// rocXolid communication controllers
use Softworx\RocXolid\Communication\Http\Controllers\AbstractCrudController;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models\SmsNotification;
// rocXolid communication repositories
use Softworx\RocXolid\Communication\Repositories\SmsNotification\Repository;
// rocXolid communication controller traits
use Softworx\RocXolid\Communication\Http\Controllers\Traits\SendsTestNotifications;

/**
 * SMS notification CRUD controller.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Admin
 * @version 1.0.0
 */
class Controller extends AbstractCrudController
{
    use SendsTestNotifications;

    /**
     * {@inheritDoc}
     */


    /**
     * {@inheritDoc}
     */
    protected static $repository_class = Repository::class;
}
