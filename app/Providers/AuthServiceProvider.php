<?php

namespace App\Providers;

use App\Article;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

//        Gate::define('update-article', function (User $user, Article $article) {
//            return $article->user->is($user);
//        });

        Gate::before(function ($user, $ability) {
            return $user->abilities()->contains($ability);
        });
    }
}
