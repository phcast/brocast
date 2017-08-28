<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
//        Broadcast::channel('App.User.*', function ($user, $userId) {
//            return (int) $user->id === (int) $userId;
//        });
    
        Broadcast::channel('chat', function ($user) {
            //return true;
            return Auth::check();
        });
        
    }
}