<?php

namespace Softworx\RocXolid\Communication\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as IlluminateAuthServiceProvider;
// rocXolid communication policies
use Softworx\RocXolid\Communication\Policies;
// rocXolid communication models
use Softworx\RocXolid\Communication\Models;

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
        Models\EmailNotification::class => Policies\SendablePolicy::class,
        Models\SmsNotification::class => Policies\SendablePolicy::class,
    ];

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->registerPolicies();
    }
}
