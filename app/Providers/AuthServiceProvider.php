<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport; //passport
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(); //passport

        // access_token 設定核發後15天後過期
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
    
        // refresh_token 設定核發後30天後過期
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
