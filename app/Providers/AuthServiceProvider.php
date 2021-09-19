<?php

namespace App\Providers;

use App\Entities\User\UserStorage;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @param UserStorage $userStorage
     * @return void
     */
    public function boot(UserStorage $userStorage)
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        $this->app['auth']->viaRequest('api', function ($request) use ($userStorage) {
            if (!empty($request->getUser()) && !empty($request->getPassword())) {
               return $userStorage->login($request->getUser(), $request->getPassword());
            }
            return null;
        });
    }
}
