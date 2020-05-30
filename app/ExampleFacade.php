<?php


namespace App;


use Illuminate\Support\Facades\Facade;

class ExampleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Example::class;
//        return 'example';
    }
}
//tinker
//App\ExampleFacade::handle();
//>>> app('example');
//=> App\Example {#3057}
//>>> resolve('example');
//=> App\Example {#3060}
