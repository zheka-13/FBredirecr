<?php

namespace App\Providers;

use App\Repositories\UsersRepository;
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
     * @param UsersRepository $usersRepository
     * @return void
     */
    public function boot(UsersRepository $usersRepository)
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) use ($usersRepository) {
            if (!empty($request->getUser()) && !empty($request->getPassword())) {
               return $usersRepository->loginUser($request->getUser(), $request->getPassword());
            }
            return null;
        });
    }
}
