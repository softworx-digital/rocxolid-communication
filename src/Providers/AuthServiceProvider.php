<?php

namespace Softworx\RocXolid\Communication\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as IlluminateAuthServiceProvider;
// rocXolid model contracts
use Softworx\RocXolid\Models\Contracts\Crudable;
// rocXolid user management policies
use Softworx\RocXolid\Communication\Policies\SendablePolicy;
// rocXolid user management models
use Softworx\RocXolid\Communication\Models\EmailNotification;
use Softworx\RocXolid\Communication\Models\SmsNotification;

/**
 * rocXolid communication authorization service provider.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class AuthServiceProvider extends IlluminateAuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        EmailNotification::class => SendablePolicy::class,
        SmsNotification::class => SendablePolicy::class,
    ];

    public function register()
    {
        $this->registerPolicies();
    }
}
