<?php

namespace App\Providers;

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
        //
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
