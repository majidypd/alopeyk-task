<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);


       /* Auth::viaRequest('jwt', function ($request, $i) {
            $user_id = JWT::decode($request->token, env('APP_KEY'), ['HS256']);
            return User::where('token', $request->token)->first();
        });*/
    }

}
