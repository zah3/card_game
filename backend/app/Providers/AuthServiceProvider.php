<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    public const EXPIRE_TOKENS_IN_DAYS = 1;
    public const EXPIRE_TOKENS_WITH_REMEMBER_ME_IN_DAYS = 7;
    public const REFRESH_EXPIRE_TOKENS_IN_DAYS = 30;
    public const TOKEN_TYPE = 'Bearer';
    public const TOKEN_NAME = 'Card_game';
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Passport
        Passport::routes();

//        Passport::tokensExpireIn(now()->addDays(self::EXPIRE_TOKENS_IN_DAYS));
//
//        Passport::refreshTokensExpireIn(now()->addDays(self::REFRESH_EXPIRE_TOKENS_IN_DAYS));
    }
}
