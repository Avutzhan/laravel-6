<?php

namespace App\Providers;

use App\Container;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        app()->bind('App\Example', function( ) { or
//        $this->app->bind('App\Example', function( ) { every time new instance
        //singleton every time exact same instance
        $this->app->singleton('App\Example', function( ) {
            $container = new Container();
            $foo = 'foobar';

            return new \App\Example($container, $foo);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'series' => 'App\Series',
            'collection' => 'App\Collection'

        ]);

        // если ты не хочешь чтобы в базе было написано App\Series и так далее то нужно тут в методе бут прописать этот код чтобы ларка понимала что означает серия и колекция в базе данных
    }
}
