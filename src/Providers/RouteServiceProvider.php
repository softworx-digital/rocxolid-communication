<?php

namespace Softworx\Rocxolid\Communication\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Softworx\RocXolid\Services\CrudRouterService;

/**
 * rocXolid routes service provider.
 *
 * @author softworx <hello@softworx.digital>
 * @package Softworx\RocXolid\Communication
 * @version 1.0.0
 */
class RouteServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap rocXolid routing services.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function boot()
    {
        $this
            ->load($this->app->router);

        return $this;
    }

    /**
     * Define the routes for the package.
     *
     * @param  \Illuminate\Routing\Router $router Router to be used for routing.
     * @return \Illuminate\Support\ServiceProvider
     */
    private function load(Router $router): IlluminateServiceProvider
    {
        $router->group([
            'module' => 'rocXolid-communication',
            'middleware' => [ 'web', 'auth.rocXolid' ],
            'namespace' => '',
            'prefix' => sprintf('%s/communication', config('rocXolid.admin.general.routes.root', 'rocXolid')),
            'as' => 'rocxolid.communication.',
        ], function ($router) {
            CrudRouter::create('email-order-notification', Http\Controllers\EmailOrderNotification\Controller::class);
            CrudRouter::create('sms-order-notification', Http\Controllers\SmsOrderNotification\Controller::class);
            CrudRouter::create('email-user-notification', Http\Controllers\EmailUserNotification\Controller::class);
            CrudRouter::create('sms-user-notification', Http\Controllers\SmsUserNotification\Controller::class);
            CrudRouter::create('email-system-notification', Http\Controllers\EmailSystemNotification\Controller::class);
            CrudRouter::create('sms-system-notification', Http\Controllers\SmsSystemNotification\Controller::class);
            // logs
            CrudRouter::create('communication-log', Http\Controllers\CommunicationLog\Controller::class);

            $router->group([
                'namespace' => 'Softworx\RocXolid\Communication\Http\Controllers\CommunicationLog',
                'prefix' => 'communication-log',
            ], function ($router) {
                $router->get('/model/{relation}/{id}', 'Controller@modelLog');
            });
        });

        return $this;
    }
}
