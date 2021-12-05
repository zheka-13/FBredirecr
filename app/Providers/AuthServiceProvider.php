<?php

namespace App\Providers;

use App\Entities\User\UserService;
use Illuminate\Support\ServiceProvider;
use Throwable;

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
     * @param UserService $userService
     * @return void
     */
    public function boot(UserService $userService)
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        $this->app['auth']->viaRequest('api', function ($request) use ($userService) {

            $user_id = $this->app['session']->get("user_id");
            if (empty($user_id)){
                return null;
            }
            try {
                return $userService->getUserModel($user_id);
            }
            catch (Throwable $e){
                return null;
            }
        });
    }
}
