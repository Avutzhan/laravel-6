<?php
use Illuminate\Support\Facades\Route;
use App\Article;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//app()->bind('example', function( ) {
//
//    return new \App\Example();
//});
//app()->bind('App\Example', function( ) {
//    $container = new \App\Container();
//    $foo = 'foobar';
//  mailtrap
//    return new \App\Example($container, $foo);
//}); это все переносим в папку провадерс апп сервис провайдер
Route::get('/payments/create', 'ArticlesController@paymentCreate')->middleware('auth');
Route::post('/payments', 'ArticlesController@paymentStore')->middleware('auth');
Route::get('/notifications', 'ArticlesController@showNots')->middleware('auth');


Route::get('/form', 'ArticlesController@form');
Route::get('/sendmail', 'ArticlesController@sendmail');
Route::post('/sendmail', 'ArticlesController@storeemail');
Route::post('/form', 'ArticlesController@storemore');
Route::get('/posts/{post}', 'PostsController@show');

//Route::get('/', 'FruitController@index');
//Route::get('/', function(App\Example $example) {
////    $test = resolve(App\Example::class);
////    $test = app()->make(App\Example::class);
//// две вышестоящие команды это ручное вытягивание класса но можно запихать класс в аргументы функции и ларка сама все это пропишет и вытянет
//    ddd($example);
//});
Route::get('/', function() {
//    $user = App\User::first();
//
//    $post = $user->posts()->create([
//        'title' => 'foo',
//        'body' => 'lorem ipsum'
//    ]);

    \Illuminate\Support\Facades\Cache::remember('foo', 60, function () {
        return 'foobar';
    });

    return \Illuminate\Support\Facades\Cache::get('foo');

//return \Illuminate\Support\Facades\File::get(public_path('index.php'));
//return request('name');
//return \Illuminate\Support\Facades\Request::input('name');
//    return view('welcome');
//    return \Illuminate\Support\Facades\View::make('welcome');

    //in tinker
    //app()->bind('key', function () { return 'here you go';});
    //resolve('key');
    //resolve('request');
    //File::get(public_path('index.php'));
    //resolve('files');
});
Route::get('/about', function() {
    return view('about', [
        'articles' => Article::take(2)->latest()->get()
    ]);
});
Route::get('/articles', 'ArticlesController@index')->name('articles.index');
Route::post('/articles', 'ArticlesController@store');

Route::get('/articles/create', 'ArticlesController@create');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::put('/articles/{article}', 'ArticlesController@update');

Route::get('/articles/{article}/edit', 'ArticlesController@edit');
Route::delete('/articles/{article}', 'ArticlesController@delete');

// requests GET POST PUT DELETE
// GET /articles   index
// GET /articles/id    show
// POST /articles    create
// PUT /articles/id    update
// DELETE /articles/id    delete


//GET /videos           index
//GET /videos/create    create
//POST /videos          create
//GET /videos/2         show
//GET /videos/2/edit    edit
//PUT /videos/2         update
//DELETE /videos/2/     delete

//GET /videos/subscribe
//PUT /videos/subscription create


//CSRF attacked route
Route::get('/logout', function () {
    auth()->logout();

    return 'You are now logged out';
});

//<img src="http://laravel-6.local/logout" alt=""> attacker
//<form action="http://laravel-6.local/logout" method="POST">
//        <button>Continue</button>
//    </form>
//form will return 419 page because laravel protects csrf attacks out of the box

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home')->middleware('auth');
